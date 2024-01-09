<?php
/** @var xPDOTransport $transport */
if (!$transport->xpdo || !($transport instanceof xPDOTransport)) {
	return false;
}

/** @var modX $modx */
$modx = $transport->xpdo;
$packages = [
	'pdoTools' => 'modx.com',
];

/**
 * Installs a MODX package.
 * @param string $packageName The name of the package.
 * @param string|null $providerName The name of the package provider.
 * @return array An array with the installation result:
 *     - success: An integer (0 or 1) - 1 in case of successful installation, 0 otherwise.
 *     - message: A message about the installation result.
 */
function installPackage($packageName, $providerName)
{
	if (!$providerName || !$provider = $modx->getObject('transport.modTransportProvider', ['service_url:LIKE' => '%' . $providerName . '%'])) {
		$provider = $modx->getObject('transport.modTransportProvider', 1);
	}

	$finedPackages = $provider->find(['query' => $packageName]);
	$filteredPackages = array_filter($finedPackages[1], fn($item) => strtolower($item['name']) === strtolower($packageName));
	$installablePackage = $filteredPackages ? reset($filteredPackages) : false;
	$managerLanguage = $modx->getOption('manager_language');
	$messages = [
		'ru' => [
			'already_installed' => "Дополнение <b>{$packageName}</b> уже было установлено",
			'not_found' => "Дополнение <b>{$packageName}</b> не найдено в репозитории {$providerName}",
			'minimum_supports' => "Дополнение <b>{$packageName}</b> требует минимальную версию системы {$installablePackage['minimum_supports']}",
			'download_failed' => "Дополнение <b>{$packageName}</b> не удалось скачать",
			'not_found_during_installation' => "Дополнение <b>{$packageName}</b> не найдено при установке",
			'installed' => "Дополнение <b>{$packageName}</b> установлено",
			'install_failed' => "Дополнение <b>{$packageName}</b> не удалось установить",
		],
		'en' => [
			'already_installed' => "The add-on <b>{$packageName}</b> has already been installed",
			'not_found' => "The add-on <b>{$packageName}</b> was not found in the {$providerName} repository",
			'minimum_supports' => "The add-on <b>{$packageName}</b> requires a minimum system version of {$installablePackage['minimum_supports']}",
			'download_failed' => "Failed to download the add-on <b>{$packageName}</b>",
			'not_found_during_installation' => "The add-on <b>{$packageName}</b> was not found during installation",
			'installed' => "The add-on <b>{$packageName}</b> has been installed",
			'install_failed' => "Failed to install the add-on <b>{$packageName}</b>",
		],
	];

	$messages = isset($messages[$managerLanguage]) ? $messages[$managerLanguage] : $messages['en'];

	if ($modx->getObject('transport.modTransportPackage', ['package_name' => $packageName, 'installed:IS NOT' => null])) {
		return [
			'success' => 1,
			'message' => $messages['already_installed'],
		];
	}

	if (!$installablePackage) {
		return [
			'success' => 0,
			'message' => $messages['not_found'],
		];
	}

	if ($installablePackage['minimum_supports'] > $modx->version['full_version']) {
		return [
			'success' => 0,
			'message' => $messages['minimum_supports'],
		];
	}

	// Download the package
	$download = $provider->transfer($installablePackage['signature'], null, ['location' => $installablePackage['location']]);
	if (!$download) {
		return [
			'success' => 0,
			'message' => $messages['download_failed'],
		];
	}

	// Install the package
	$package = $modx->getObject('transport.modTransportPackage', ['signature' => $installablePackage['signature']]);

	if (!$package) {
		return [
			'success' => 0,
			'message' => $messages['not_found_during_installation'],
		];
	}

	if ($package->save() && $package->install()) {
		return [
			'success' => 1,
			'message' => $messages['installed'],
		];
	}

	return [
		'success' => 0,
		'message' => $messages['install_failed'],
	];
}

$success = false;
/** @var array $options */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
	case xPDOTransport::ACTION_UPGRADE:
		foreach ($packages as $name => $providerName) {
			$modx->log(modX::LOG_LEVEL_INFO, $modx->getOption('manager_language') == 'ru' ? "Попытка установки <b>{$name}</b>. Пожалуйста, подождите..." : "Trying to install <b>{$name}</b>. Please wait...");
			$response = installPackage($name, $providerName);
			$level = $response['success']
				? modX::LOG_LEVEL_INFO
				: modX::LOG_LEVEL_ERROR;
			$modx->log($level, $response['message']);
		}
		$success = true;
		break;

	case xPDOTransport::ACTION_UNINSTALL:
		$success = true;
		break;
}

return $success;
