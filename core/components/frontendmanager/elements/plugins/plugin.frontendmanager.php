<?php
if (!$modx->user->hasSessionContext('mgr') || !$modx->user->isMember('Administrator')) return;
switch ($modx->event->name) {
    case 'OnWebPagePrerender':
		if (!$modx->resource->get('template')) break;
        $frontendManager = $modx->getService('frontendmanager','frontendManager', MODX_CORE_PATH . 'components/frontendmanager/model/frontendmanager/', array());
        if(!$frontendManager) return;
		$contentTypes = explode(',', $modx->getOption('frontendmanager_contenttypes'));
        if (in_array($modx->resource->content_type, $contentTypes)) {
            $html = $frontendManager->initialize($modx->context->key);
            
            if (strpos($modx->resource->_output, '</body>') !== false) {
                $modx->resource->_output =
                    preg_replace("#(</body>)#i", $html . "\n\\1", $modx->resource->_output, true);
            } else {
                $modx->resource->_output .= $html;
            }
        }
        break;
    case 'OnBeforeManagerPageInit':
        if ($_GET['frame']) {
			$modx->regClientCSS(MODX_ASSETS_URL.'components/frontendmanager/css/mgr/'.$modx->getOption('frontendmanager_manager_css', NULL, 'manager.css'));
			$modx->regClientStartupScript(MODX_ASSETS_URL.'components/frontendmanager/js/mgr/'.$modx->getOption('frontendmanager_manager_js', NULL, 'manager.js'));
        }
        break;
    default:
        break;
}
return;
