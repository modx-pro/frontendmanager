<?php
if($modx->event->name != 'OnLoadWebDocument' || !$modx->user->isAuthenticated('mgr')) return;
$frontendManager = $modx->getService('frontendmanager','frontendManager', MODX_CORE_PATH . 'components/frontendmanager/model/frontendmanager/', array());
if(!$frontendManager) die('error load frontendmanager');
$frontendManager->initialize($modx->context->key);
