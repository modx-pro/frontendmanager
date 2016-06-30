var frontendManager = {
	initialize: function() {
		console.log('loadded');
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
			    src: link
			  },
			  type: 'iframe',
			  callbacks: {
			  	beforeAppend: function() {
				    // iframe загружен
				    this.content.find('iframe').on('load', function() {
				      $(this).contents().find("head").append($("<style type='text/css'>  #modx-header, #modx-leftbar, .x-layout-split, #modx-abtn-duplicate, #modx-abtn-preview, #modx-abtn-cancel, #modx-abtn-help {display:none !important;} #modx-action-buttons {top: 0;} #modx-content {width:100% !important}  </style>"));
				    });
				 }
			  }
			  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
			  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
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