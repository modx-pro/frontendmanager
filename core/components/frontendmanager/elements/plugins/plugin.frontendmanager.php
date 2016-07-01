<?php
if(!$modx->user->isAuthenticated('mgr')) return;
switch ($modx->event->name) {
    case 'OnLoadWebDocument':
        $frontendManager = $modx->getService('frontendmanager','frontendManager', MODX_CORE_PATH . 'components/frontendmanager/model/frontendmanager/', array());
        if(!$frontendManager) die('error load frontendmanager');
        $frontendManager->initialize($modx->context->key);
        break;
    case 'OnBeforeManagerPageInit':
        if ($_GET['frame']) {
			$modx->regClientCSS('/assets/components/frontendmanager/css/mgr/'.$modx->getOption('frontendmanager_manager_css', NULL, 'manager.css'));
			$modx->regClientStartupScript('/assets/components/frontendmanager/js/mgr/'.$modx->getOption('frontendmanager_manager_js', NULL, 'manager.js'));
        }
        break;
    default:
        break;
}
return;
