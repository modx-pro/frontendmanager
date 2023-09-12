<?php
class frontendManager {
	/* @var modX $modx */
	public $modx;

	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()){
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('frontendmanager_core_path', $config, $this->modx->getOption('core_path') . 'components/frontendmanager/');
		$assetsUrl = $this->modx->getOption('frontendmanager_assets_url', $config, $this->modx->getOption('assets_url') . 'components/frontendmanager/');
		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'connectorUrl' => $connectorUrl,
			'position' => $this->modx->getOption('frontendmanager_frontend_position', null, 'top'),
			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);

		$this->modx->addPackage('frontendmanager', $this->config['modelPath']);
		$this->modx->lexicon->load('frontendmanager:default');

		$this->pdoTools = $this->modx->getService('pdoFetch');
		$this->pdoTools->setConfig($this->config);
	}


	public function initialize($ctx = 'web', $scriptProperties = array()){

		$this->config = array_merge($this->config, $scriptProperties);
		if (!empty($this->initialized[$ctx])) {
			return true;
		}
		$this->initialized[$ctx] = true;

		$config_js = array(
			'ctx' => $ctx,
			'jsUrl' => $this->config['jsUrl'],
			'cssUrl' => $this->config['cssUrl'],
			'position' => $this->config['position'],
			'auth' => $this->modx->user->getUserToken('mgr'),
			'modal' => [
				'textModalLoad' => $this->modx->lexicon('frontendmanager_text_modal_load')
			],
		);

		$output = &$this->modx->resource->_output;
		$assets = [];

		if (strpos($output, '</head>') === false || strpos($output, '</body>') === false) {
			return;
		}

		$assets[] = '<link rel="stylesheet" href="' . $this->config['cssUrl'].'web/'.$this->modx->getOption('frontendmanager_frontend_css', NULL, 'frontend.css') . '" type="text/css">';
		$assets[] = '<script defer>frontendManagerConfig=' . $this->modx->toJSON($config_js) . ';</script>';
		$assets[] = '<script src="' . $this->config['jsUrl'].'web/'.$this->modx->getOption('frontendmanager_frontend_js', NULL, 'frontend.js') . '" defer></script>';

		$chunk_fm = $this->pdoTools->getChunk($this->modx->getOption('frontendmanager_frontend_tpl', NULL, 'tpl.frontendmanager.panel'));

		$assets = join(PHP_EOL, $assets);

		$output = preg_replace("/(<\/head>)/i", $assets . "\n\\1", $output, 1);
		$output = preg_replace("/(<\/body>)/i", $chunk_fm . "\n\\1", $output, 1);
	}
}
