<div id="frontendManager" class="fm-panel" tabindex="0">
	<a href="{'manager_url' | config}" target="_blank" class="fm-mode"><img src="{'manager_url' | config}templates/default/images/modx-icon-color.svg"></a>
	<div class="fm-row">
		<a href="{'manager_url' | config}?a=resource/update&id={$_modx->resource.id}" data-action="iframe"><span class="fm-icon-edit"></span> <span class="fm-link-text">{'frontendmanager_btn_edit' | lexicon}</span></a>
		<a href="{'manager_url' | config}?a=security/user" data-action="iframe"><span class="fm-icon-user"></span> <span class="fm-link-text">{'frontendmanager_btn_users' | lexicon}</span></a>
		<a href="{'manager_url' | config}?a=mgr/orders&namespace=minishop2" data-action="iframe"><span class="fm-icon-ms2"></span> <span class="fm-link-text">{'frontendmanager_btn_ms2' | lexicon}</span></a>
		<a href="{'manager_url' | config}?id=0&a=context/update&key={$_modx->context.key}" data-action="iframe"><span class="fm-icon-context"></span> <span class="fm-link-text">{'frontendmanager_btn_context' | lexicon}</span></a>
		<a href="{'manager_url' | config}?a=system/settings" data-action="iframe"><span class="fm-icon-settings"></span> <span class="fm-link-text">{'frontendmanager_btn_settings' | lexicon}</span></a>
		<a href="{'manager_url' | config}?a=system/event" data-action="iframe"><span class="fm-icon-log"></span><span class="fm-link-text">{'frontendmanager_btn_log' | lexicon}</span></a>
		<a href="{'manager_url' | config}?a=system/refresh_site" data-action="iframe"><span class="fm-icon-cache"></span><span class="fm-link-text">{'frontendmanager_btn_cache' | lexicon}</span></a>
	</div>
</div>
