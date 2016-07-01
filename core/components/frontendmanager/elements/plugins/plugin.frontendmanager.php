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
            $modx->controller->addHtml('<script>Ext.onReady(function() {
                setTimeout(function() {
                    if (Ext.getCmp("modx-panel-resource")) {
                        Ext.getCmp("modx-panel-resource").on("success", function(){top.window.location.href = top.window.location.href});
                    }
                    if (Ext.getCmp("modx-panel-chunk")) {
                        Ext.getCmp("modx-panel-chunk").on("success", function(){top.window.location.href = top.window.location.href});
                    }
                }, 1000);
            });
            </script>');
        }
        break;
    default:
        break;
}
return;
