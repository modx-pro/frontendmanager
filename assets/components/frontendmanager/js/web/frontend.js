const frontendManager = {
	config: {
		panel: '.fm-panel',
	},
	initialize() {
		if (typeof frontendManagerConfig === 'undefined') return;

		document.body.classList.add('fm', `fm-pos-${frontendManagerConfig.position}`);
		if (this.getCookie('fm-hide')) document.body.classList.add('fm-hide');

		document.querySelectorAll('a[data-action="iframe"]').forEach((i) => i.addEventListener('click', (e) => {
			e.preventDefault();
			this.open(i.getAttribute('href'));
		}));

		document.querySelectorAll('.fm-mode').forEach((i) => i.addEventListener('click', (e) => {
			e.preventDefault();
			document.cookie = `fm-hide=${document.body.classList.contains('fm-hide') ? '' : '1'}`;
			document.body.classList.toggle('fm-hide');
		}));
	},
	open(url) {
		const modal = document.createElement('div');
		const closeButton = document.createElement('button');
		const iframe = document.createElement('iframe');
		const iframeWrapper = document.createElement('div');
		const closeModal = () => {
			document.body.style.overflow = '';
			document.body.removeChild(modal);
		}

		modal.classList.add('fm-modal');
		closeButton.classList.add('fm-btn-close');
		iframeWrapper.classList.add('fm-iframe-wrapper');
		iframe.src = `${url}&frame=1`;

		iframeWrapper.appendChild(iframe);
		modal.appendChild(closeButton);
		modal.appendChild(iframeWrapper);
		document.body.appendChild(modal);
		document.body.style.overflow = 'hidden';
		document.addEventListener('click', (e) => {
			if (e.target.classList.contains('fm-modal') || e.target.classList.contains('fm-btn-close')) closeModal();
		});
	},
	getCookie(name) {
		const result = document.cookie.match(`(^|[^;]+)\s*${name}\s*=\s*([^;]+)`);
		return result ? decodeURIComponent(result.pop()) : undefined;
	}
};

document.addEventListener('DOMContentLoaded', () => {
	frontendManager.initialize();
});
