var frontendManager = {
	initialize: function() {

		if (!jQuery().MagnificPopup) {
			document.write('<script src="' + frontendManagerConfig.jsUrl + 'plugins/jquery.magnific-popup.min.js"><\/script>');
		}

		$('body').addClass('fm');


		// listeners
		$(document).on('click', 'a[data-action="iframe"]', function() {
			frontendManager.open($(this).attr('href'));
			return false;
		});


	},
	open: function(link){
			$.magnificPopup.open({
			  items: {
			    src: link + '&frame=1'
			  },
			  type: 'iframe'
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
