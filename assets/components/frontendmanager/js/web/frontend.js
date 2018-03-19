/*
<script>
window.onload = function() {
    var editor = ContentTools.EditorApp.get();
    editor.init('[data-editable], [data-fixture]', 'data-name');
    editor.addEventListener('saved', function(ev) {
        var saved;
      console.log(ev.detail().regions);
      if (Object.keys(ev.detail().regions).length === 0) {
        return;
      }

      const html = ev.detail().regions[0];
      // console.log(html);

      const data = new FormData();
      data.append('content', html)
      data.append('action', 'resource/update')
      data.append('id', '1')
      data.append('context_key', 'web')
      data.append('syncsite', 1)
      data.append('HTTP_MODAUTH', frontendManagerConfig.auth)

      axios.post(`http://s12789.h7.modhost.pro/connectors/index.php`, data, {
          headers: {
              'Upgrade-Insecure-Requests': 1,
              // 'Referer': 'http://s12789.h7.modhost.pro/manager/?a=resource/update&id=1',
              // 'Ref2': 123
          }
      })

      // return;


      editor.busy(true);
      saved = (function(_this) {
        return function() {
          editor.busy(false);
          return new ContentTools.FlashUI('ok');
        };
      })(this);
      return setTimeout(saved, 2000);
    })

}
</script>
*/


const frontendManager = {
	config: {
		panel: '.fm-panel',
	},
	initialize: () => {
		if (!jQuery().MagnificPopup) document.write('<script src="' + frontendManagerConfig.jsUrl + 'plugins/jquery.magnific-popup.min.js"><\/script>');
		$('body').addClass('fm fm-pos-' + frontendManagerConfig.position);
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

		// editor
		const editor = ContentTools.EditorApp.get()
    editor.init('[data-editable], [data-fixture]', 'data-name')
		editor.addEventListener('saved', function(ev) {
			const regions = ev.detail().regions
      if (Object.keys(regions).length === 0) return

			editor.busy(true)
      const data = new FormData();
      data.append('content', ev.detail().regions[0])
      data.append('action', 'resource/update')
      data.append('id', '1')
      data.append('context_key', 'web')
      data.append('syncsite', 1)
      data.append('HTTP_MODAUTH', frontendManagerConfig.auth)

      axios.post(`http://s12789.h7.modhost.pro/connectors/index.php`, data, {
          headers: {
              'Upgrade-Insecure-Requests': 1,
              // 'Referer': 'http://s12789.h7.modhost.pro/manager/?a=resource/update&id=1',
              // 'Ref2': 123
          }
      })
			.then(response => {
				editor.busy(false)
				console.log(response.data);
			})

    })

	},

	open: (link) => {
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
