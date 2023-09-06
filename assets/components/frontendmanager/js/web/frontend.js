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
	nodes: {
		modal: undefined,
		iframeWrapper: undefined,
		iframe: undefined,
		closeButton: undefined,
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

		document.addEventListener('click', (e) => {
			if (e.target.classList.contains(className.general) || e.target.classList.contains(className.closeButton)) {
				this.close();
			}
		});

		this.createModal();
	},
	createModal() {
		const { className, id: modalId } = this.config.modal;

		this.nodes.modal = document.createElement('div');
		this.nodes.closeButton = document.createElement('button');
		this.nodes.iframe = document.createElement('iframe');
		this.nodes.iframeWrapper = document.createElement('div');

		this.nodes.modal.id = modalId;
		this.nodes.modal.classList.add(className.general);
		this.nodes.closeButton.classList.add(className.closeButton);
		this.nodes.iframeWrapper.classList.add(className.iframeWrapper);

		this.nodes.iframeWrapper.appendChild(this.nodes.iframe);
		this.nodes.iframeWrapper.dataset.textLoad = frontendManagerConfig.modal.textModalLoad;
		this.nodes.modal.append(this.nodes.closeButton, this.nodes.iframeWrapper);
	},
	open(url) {
		this.nodes.iframe.src = `${url}&frame=1`;

		document.body.appendChild(this.nodes.modal);
		document.body.style.overflow = 'hidden';
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
