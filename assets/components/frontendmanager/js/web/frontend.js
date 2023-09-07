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

		this.panel = document.querySelector(this.config.panel);

		document.body.classList.add('fm', `fm-pos-${frontendManagerConfig.position}`);
		this.getCookie(cookieKey) && document.body.classList.add(cookieKey);

		this.panel.querySelectorAll(':scope a[data-action="iframe"]')
			.forEach((i) => i.addEventListener('click', (e) => {
				e.preventDefault();
				this.open(i.getAttribute('href'));
			}));

		document.querySelectorAll(`.${className.modeButton}`)
			.forEach((i) => i.addEventListener('click', (e) => {
				e.preventDefault();
				document.cookie = `${cookieKey}=${document.body.classList.contains(cookieKey) ? '' : '1'}`;
				document.body.classList.toggle(cookieKey);
			}));

		this.createModal();
	},
	createModal() {
		const { className, id: modalId } = this.config.modal;

		this.modal = document.createElement('div');
		this.modal.id = modalId;
		this.modal.classList.add(className.general);

		this.closeButton = document.createElement('button');
		this.closeButton.classList.add(className.closeButton);

		this.iframe = document.createElement('iframe');
		this.iframeWrapper = document.createElement('div');
		this.iframeWrapper.classList.add(className.iframeWrapper);
		this.iframeWrapper.append(this.iframe);
		this.iframeWrapper.dataset.textLoad = frontendManagerConfig.modal.textModalLoad;

		this.modal.append(this.closeButton, this.iframeWrapper);

		document.addEventListener('click', ({ target }) => {
			if (target !== this.modal && target !== this.closeButton) {
				return;
			}

			this.close();
		});
	},
	open(url) {
		this.iframe.src = url + '&frame=1';
		document.body.style.overflow = 'hidden';
		document.body.append(this.modal);
	},
	close() {
		document.body.removeChild(this.modal);
		document.body.style.overflow = '';
		this.iframe.src = '';
	},
	getCookie(name) {
		const result = document.cookie.match(`(^|[^;]+)\s*${name}\s*=\s*([^;]+)`);
		return result ? decodeURIComponent(result.pop()) : undefined;
	}
};

document.addEventListener('DOMContentLoaded', () => {
	frontendManager.initialize();
});
