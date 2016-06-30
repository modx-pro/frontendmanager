<?php

/**
 * Class frontendManagerMainController
 */
abstract class frontendManagerMainController extends frontendManagerManagerController {
	/** @var frontendManager $frontendManager */
	public $frontendManager;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('frontendmanager_core_path', null, $this->modx->getOption('core_path') . 'components/frontendmanager/');
		require_once $corePath . 'model/frontendmanager/frontendmanager.class.php';

		$this->frontendManager = new frontendManager($this->modx);
		//$this->addCss($this->frontendManager->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->frontendManager->config['jsUrl'] . 'mgr/frontendmanager.js');
		$this->addHtml('
		<script type="text/javascript">
			frontendManager.config = ' . $this->modx->toJSON($this->frontendManager->config) . ';
			frontendManager.config.connector_url = "' . $this->frontendManager->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('frontendmanager:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends frontendManagerMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}