<?php

$exists = $chunks = false;
$output = null;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
		$exists = $modx->getObject('transport.modTransportPackage', array('package_name' => 'pdoTools'));
		break;

	case xPDOTransport::ACTION_UPGRADE:
		$exists = $modx->getObject('transport.modTransportPackage', array('package_name' => 'pdoTools'));
		if (!empty($options['attributes']['chunks'])) {
			$chunks = '<ul id="formCheckboxes" style="height:200px;overflow:auto;">';
			foreach ($options['attributes']['chunks'] as $k => $v) {
				$chunks .= '
				<li>
					<label>
						<input type="checkbox" name="update_chunks[]" value="' . $k . '"> ' . $k . '
					</label>
				</li>';
			}
			$chunks .= '</ul>';
		}
		break;

	case xPDOTransport::ACTION_UNINSTALL:
		break;
}

$output = '';
$messages = array(
	'ru' => array(
			'dependency' => 'В качестве зависимости требуется <b>pdoTools</b>.<br/>Он будет автоматически скачан и установлен.',
			'chunks' => 'Выберите чанки, которые нужно <b>перезаписать</b>:<br/>
					<small>
							<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = true;});">отметить все</a> |
							<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = false;});">снять со всех</a>
					</small>'
	),
	'default' => array(
			'dependency' => 'The <b>pdoTools</b> dependency is required.<br/>It will be automatically downloaded and installed.',
			'chunks' => 'Select chunks, which need to <b>overwrite</b>:<br/>
					<small>
							<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = true;});">select all</a> |
							<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = false;});">deselect all</a>
					</small>'
	)
);

$language = $modx->getOption('manager_language');
$output = '';

if (!$exists) {
	$output .= isset($messages[$language]) ? $messages[$language]['dependency'] : $messages['default']['dependency'];
}

if ($chunks) {
	if (!$exists) {
			$output .= '<br/><br/>';
	}

	$output .= isset($messages[$language]) ? $messages[$language]['chunks'] : $messages['default']['chunks'];

	$output .= $chunks;
}


return $output;
