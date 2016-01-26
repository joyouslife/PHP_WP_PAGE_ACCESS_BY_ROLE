<?php

namespace jteam\app;

use Exception;
use jteam\app\WpFacade;

class App
{
	private $_config = array();
	public $facade = null;
	public $renderData = array();

	const PlUGIN_MAIN_FILE_CONFIG_KEY = 'plugin_main_file';
	const PlUGIN_NAMESPACE_CONFIG_KEY = 'namespace';

	public function __construct($config)
	{
		if (!is_array($config)) {
			throw new Exception('$config most be array');
		}

		$this->_config = $config;

		$this->_onInitFacade();
	} // end __construct

	private function _onInitFacade()
	{
		require_once 'WpFacade.php';

		$pluginMainFile = $this->getPluginMainFile();

		$this->facade = new WpFacade($pluginMainFile);
	} // end _onInitFacade

	public function getPluginMainFile()
	{
		return $this->getConfigValue(self::PlUGIN_MAIN_FILE_CONFIG_KEY);
	} // end getPluginMainFile

	public function getConfigValue($key)
	{
		if (!$this->_hasValueInConfig($key)) {
			throw new Exception(
				'Not found '.$key.' in config file'
			);
		}

		return $this->_config[$key];
	} // end getConfigValue

	private function _hasValueInConfig($key)
	{
		return array_key_exists($key, $this->_config);
	} // end _hasValueInConfig


	public function run()
	{
		$this->_onInit();
	} // end run

	private function _onInit()
	{
		$this->_onInitBackend();
		$this->_onInitFrontend();
	} // end _onInit

	private function _onInitBackend()
	{
		if (!$this->facade->isBackend() && !$this->facade->isAjax()) {
			return false;
		}

		$filePath = $this->facade->getPluginPath('backend.php');

		if (!$this->facade->isFileExists($filePath)) {
			return false;
		}

		$app = &$this;
		require_once $filePath;
	} // end _onInitBackend

	private function _onInitFrontend()
	{
		if ($this->facade->isBackend() && !$this->facade->isAjax()) {
			return false;
		}

		$filePath = $this->facade->getPluginPath('frontend.php');

		if (!$this->facade->isFileExists($filePath)) {
			return false;
		}

		$app = &$this;
		require_once $filePath;
	} // end _onInitFrontend

	public function addAction(
		$hook, $controller, $action, $priority = 10, $paramsCount = 1
	)
	{
		$method = $this->_getControllerMethod($controller, $action);

		$this->facade->addAction($hook, $method, $priority, $paramsCount);
	} // end addAction

	public function addFilter(
		$hook, $controller, $action, $priority = 10, $paramsCount = 1
	)
	{
		$method = $this->_getControllerMethod($controller, $action);

		$this->facade->addFilter($hook, $method, $priority, $paramsCount);
	} // end addFilter

	public function getMethod($controller, $action)
	{
		return $this->_getControllerMethod($controller, $action);
	} // end getMethod

	private function _getControllerMethod($controller, $action)
	{
		$controller = $this->_prepareName($controller);
		$action = $this->_prepareName($action);

		$controllerName = ucfirst($controller).'Controller';

		$fileName = $controllerName.'.php';

		$path = $this->facade->getPluginPath('controller/'.$fileName);

		require_once($path);

		$nameSpace = $this->getPluginNamespace();

		$name = $nameSpace.'controller\\'.$controllerName;

		$controller = new $name($this);

		$actionName = $action.'Action';

		$method = array(&$controller, $actionName);

		if (!is_callable($method)) {
			throw new Exception('Undefined action '.$actionName);
		}

		return $method;
	} // end _getControllerMethod

	private function _prepareName($name = '')
	{
		$parts = explode('-', $name);

		$i = 0;

		foreach ($parts as $key => $value) {
			if (++$i == 1) {
				continue;
			}

			$parts[$key] = ucfirst($value);
		}

		$name = implode($parts);

		return $name;
	} // end _prepareName

	public function getPluginNamespace()
	{
		$namespace = $this->getConfigValue(self::PlUGIN_NAMESPACE_CONFIG_KEY);

		$namespace = "jteam\\$namespace\\";

		return $namespace;
	} // end getPluginNamespace

	public function render($template = false)
	{
		require_once 'View.php';

		$view = new View($this);

		if (!$template) {
			return $view;
		}

		return $view->render($template);
	} // end render
}