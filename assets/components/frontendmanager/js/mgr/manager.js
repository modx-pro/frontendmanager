Ext.onReady(function() {
		if (Ext.getCmp("modx-panel-resource")) {
            Ext.getCmp("modx-panel-resource").on("success", reloadFrontendManager);
        }
        if (Ext.getCmp("modx-panel-chunk")) {
            Ext.getCmp("modx-panel-chunk").on("success", reloadFrontendManager);
        }
});

function reloadFrontendManager(){
	top.window.location.href = top.window.location.href;
}