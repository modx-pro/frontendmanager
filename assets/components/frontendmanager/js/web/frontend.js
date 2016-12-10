var frontendManager = {
	config: {
		panel: '.fm-panel',
	},
	initialize: function() {
		if (!jQuery().MagnificPopup) document.write('<script src="' + frontendManagerConfig.jsUrl + 'plugins/jquery.magnific-popup.min.js"><\/script>');
		$('body').addClass('fm');
		if(getCookie('fm-hide')) $('body').addClass('fm-hide');

		$(document).on('click', 'a[data-action="iframe"]', function() {
			frontendManager.open($(this).attr('href'));
			return false;
		});

		$(document).on('click', '.fm-mode', function(event) {
			event.preventDefault();
			var body = $('body');
			document.cookie = "fm-hide=" + (body.hasClass('fm-hide') ? '' : '1');
			body.toggleClass('fm-hide');
		});
	},
	open: function(link){
		$.magnificPopup.open({
		  items: {
		    src: link + '&frame=1'
		  },
		  type: 'iframe',
		  mainClass: 'fm-modal'
		}, 0);
	}
}

if (typeof frontendManagerConfig != 'undefined'){
	frontendManager.initialize();
}

// functions
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
