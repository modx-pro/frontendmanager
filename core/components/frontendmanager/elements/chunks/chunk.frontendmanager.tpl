<div id="frontendManager" class="fm-panel" >
	<a href="[[++manager_url]]" target="_blank" class="fm-logo"><img src="[[++manager_url]]templates/default/images/modx-icon-color.svg"></a>
	<a href="[[++manager_url]]" target="_blank" class="fm-mode"><span class="fm-icon-hide"><img src="[[++manager_url]]templates/default/images/modx-icon-color.svg"></span></a>
	<a href="[[++manager_url]]?a=resource/update&id={$_modx->resource.id}" data-action="iframe"><span class="fm-icon-edit"></span> <span class="fm-link-text">{'frontendmanager_btn_edit' | lexicon}</span></a>
	<a href="[[++manager_url]]?a=security/user" data-action="iframe"><span class="fm-icon-user"></span> <span class="fm-link-text">{'frontendmanager_btn_users' | lexicon}</span></a>
	<a href="[[++manager_url]]?a=mgr/orders&namespace=minishop2" data-action="iframe"><span class="fm-icon-ms2"></span> <span class="fm-link-text">{'frontendmanager_btn_ms2' | lexicon}</span></a>
	<a href="[[++manager_url]]?id=0&a=context/update&key={$_modx->context.key}" data-action="iframe"><span class="fm-icon-context"></span> <span class="fm-link-text">{'frontendmanager_btn_context' | lexicon}</span></a>
	<a href="[[++manager_url]]?a=system/settings" data-action="iframe"><span class="fm-icon-settings"></span> <span class="fm-link-text">{'frontendmanager_btn_settings' | lexicon}</span></a>
	<a href="[[++manager_url]]?a=system/event" data-action="iframe"><span class="fm-icon-log"></span><span class="fm-link-text">{'frontendmanager_btn_log' | lexicon}</span></a>
	<a href="[[++manager_url]]?a=system/refresh_site" data-action="iframe"><span class="fm-icon-cache"></span><span class="fm-link-text">{'frontendmanager_btn_cache' | lexicon}</span></a>
</div>
