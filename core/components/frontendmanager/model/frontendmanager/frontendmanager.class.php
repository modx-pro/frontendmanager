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
		$this->modx->regClientCSS($this->config['cssUrl'].'default.css');
		$this->modx->regClientScript($this->config['jsUrl'].'default.js');
		$this->modx->regClientStartupHTMLBlock($this->pdoTools->getChunk('tpl.frontendmanager.panel'));


		$config_js = array(
				'ctx' => $ctx,
				'jsUrl' => $this->config['jsUrl'],
				'cssUrl' => $this->config['cssUrl'],
				'actionUrl' => $this->config['actionUrl'],
				'close_all_message' => $this->modx->lexicon('tickets_message_close_all'),
				'tpanel' => (int)$this->authenticated,
				'enable_editor' => (int)$this->modx->getOption('tickets.enable_editor'),
			);
			$this->modx->regClientStartupScript('<script type="text/javascript">frontendManagerConfig=' . $this->modx->toJSON($config_js) . ';</script>', true);




		$this->initialized[$ctx] = true;

	}




}