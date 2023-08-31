const frontendManager = {
	config: {
		panel: '.fm-panel',
		modal: {
			id: 'fm-modal',
			cookieKey: 'fm-hide',
			className: {
				general: 'fm-modal',
				iframeWrapper: 'fm-iframe-wrapper',
				closeButton: 'fm-btn-close',
				modeButton: 'fm-mode',
			},
		},
	},
	initialize() {
		const { cookieKey, className } = this.config.modal;
		if (typeof frontendManagerConfig === 'undefined') return;

		document.body.classList.add('fm', `fm-pos-${frontendManagerConfig.position}`);
		if (this.getCookie(cookieKey)) document.body.classList.add(cookieKey);

		document.querySelectorAll('a[data-action="iframe"]').forEach((i) => i.addEventListener('click', (e) => {
			e.preventDefault();
			this.open(i.getAttribute('href'));
		}));

		document.querySelectorAll(`.${className.modeButton}`).forEach((i) => i.addEventListener('click', (e) => {
			e.preventDefault();
			document.cookie = `${cookieKey}=${document.body.classList.contains(cookieKey) ? '' : '1'}`;
			document.body.classList.toggle(cookieKey);
		}));
	},
	open(url) {
		const { className, id: modalId } = this.config.modal;
		const modal = document.createElement('div');
		const closeButton = document.createElement('button');
		const iframe = document.createElement('iframe');
		const iframeWrapper = document.createElement('div');

		modal.id = modalId;
		modal.classList.add(className.general);
		closeButton.classList.add(className.closeButton);
		iframeWrapper.classList.add(className.iframeWrapper);
		iframe.src = `${url}&frame=1`;

		iframeWrapper.appendChild(iframe);
		iframeWrapper.setAttribute('data-text-load', frontendManagerConfig.modal.textModalLoad);
		modal.appendChild(closeButton);
		modal.appendChild(iframeWrapper);
		document.body.appendChild(modal);
		document.body.style.overflow = 'hidden';
		document.addEventListener('click', (e) => {
			if (e.target.classList.contains(className.general) || e.target.classList.contains(className.closeButton)) {
				this.close();
			}
		});
	},
	close() {
		const modal = document.getElementById(this.config.modal.id);
		document.body.style.overflow = '';

		if (!modal) return;
		document.body.removeChild(modal);
	},
	getCookie(name) {
		const result = document.cookie.match(`(^|[^;]+)\s*${name}\s*=\s*([^;]+)`);
		return result ? decodeURIComponent(result.pop()) : undefined;
	}
};

document.addEventListener('DOMContentLoaded', () => {
	frontendManager.initialize();
});
