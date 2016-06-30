<?php

$settings = array();

$tmp = array(
	/* 'frontendmanager_css' => array(
		'xtype' => 'textfield',
		'value' => 'default.css',
		'area' => 'frontendmanager_main',
	), */
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'frontendmanager_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
