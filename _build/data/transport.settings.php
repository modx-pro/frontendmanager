<?php

$settings = array();

$tmp = array(
	'frontend_css' => array(
		'xtype' => 'textfield',
		'value' => 'frontend.css',
		'area' => 'frontendmanager_frontend',
	),
	'frontend_js' => array(
		'xtype' => 'textfield',
		'value' => 'frontend.js',
		'area' => 'frontendmanager_frontend',
	),
	'frontend_tpl' => array(
		'xtype' => 'textfield',
		'value' => 'tpl.frontendmanager',
		'area' => 'frontendmanager_frontend',
	),
	'frontend_position' => array(
		'xtype' => 'textfield',
		'value' => 'top',
		'area' => 'frontendmanager_frontend',
	),
	'contenttypes' => array(
		'xtype' => 'textfield',
		'value' => '1',
		'area' => 'frontendmanager_manager',
	),

	'manager_css' => array(
		'xtype' => 'textfield',
		'value' => 'manager.css',
		'area' => 'frontendmanager_manager',
	),
	'manager_js' => array(
		'xtype' => 'textfield',
		'value' => 'manager.js',
		'area' => 'frontendmanager_manager',
	),
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
