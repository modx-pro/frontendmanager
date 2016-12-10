Ext.onReady(function() {
	if (Ext.getCmp("modx-panel-resource")) {

		// fix for change template
		/* Ext.getCmp("modx-panel-resource").on("fieldChange", function(response){
			if(response.field.hiddenName == 'template'){
				window.allow_reload = false;
			}
		}); */

        Ext.getCmp("modx-panel-resource").on("success", reloadFrontendManager);
    }
    if (Ext.getCmp("modx-panel-chunk")) {
        Ext.getCmp("modx-panel-chunk").on("success", reloadFrontendManager);
    }
});

function reloadFrontendManager(){
	top.window.location.href = top.window.location.href;
	/* if(window.allow_reload != false){
		top.window.location.href = top.window.location.href;
	}else{
		setTimeout(function(){
			window.allow_reload = true;
		}, 3000);
	} */
}