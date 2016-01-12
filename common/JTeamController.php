<?php

class JTeamController
{
	private static $_instances = array();
	private $_config;
	private $_pluginMainFile;

	const PLUGIN_MAIN_FILE_KEY = 'pluginMainFIle';
	const CLASS_NAME_PREFIX_KEY = 'classPrefix';
	const FRAMEWORK_PREFIX = 'JTeam';

	const WORDPRESS_ENGINE_IDENT = 'wordpress';

	private function __construct($config = array())
	{
		$this->_config = $config;

		$this->_pluginMainFile = $this->_getConfigValue(
			self::PLUGIN_MAIN_FILE_KEY
		);
	} // end __construct

	public static function onInitNewInstance($pluginMainFile, $config = array())
	{
		$ident = self::getPreparedIdent($pluginMainFile);

		if (self::_isExistsInstance($ident)) {
			throw new Exception("Instance already exists");
		}

		$config[self::PLUGIN_MAIN_FILE_KEY] = $pluginMainFile;

		self::_onInitNewInstance($ident, $config);
	} // end onInitNewInstance

	public static function getInstance($pluginMainFile)
	{
		$ident = self::getPreparedIdent($pluginMainFile);

		if (!self::_isExistsInstance($ident)) {
			throw new Exception("Instance did not init. Use onInitNewInstance");
		}

		return self::$_instances[$ident];
	} // end getInstance

	private static function _isExistsInstance($ident)
	{
		return array_key_exists($ident, self::$_instances);
	} // end _isExistsInstance

	private static function _onInitNewInstance($ident, $config)
	{
		self::$_instances[$ident] = new self($config);
	} // end _onInitNewInstance

	private static function getPreparedIdent($pluginMainFile)
	{
		$ident = md5($pluginMainFile);

		return $ident;
	} // end getPreparedIdent
	
	public static function onInitAbstractClass($className)
	{
		self::onInitClass($className, JTEAM_ABSTRACT_PATH);
	} // end onInitAbstractClass
	
	public static function onInitClass($className, $path)
	{
		if (class_exists($className)) {
			return false;
		}

		$fileName = $className.'.php';
		$file = $path.$fileName;

		if (!file_exists($file)) {
			throw new Exception("Not found file ".$fileName);
		}

		require_once $file;

		if (!class_exists($className)) {
			throw new Exception("Not found class ".$className." in ".$fileName);
		}
	} // end onInitClass

	private function _getConfigValue($key)
	{
		if (!$this->_hasKeyInConfig($key)) {
			throw new Exception("No found key ".$key." in config array");
		}

		return $this->_config[$key];
	} // end _getConfigValue

	private function _hasKeyInConfig($key)
	{
		return array_key_exists($key, $this->_config);
	} // end _hasKeyInConfig

	public function onPluginCoreClassStart($className)
	{
		$path = $this->_getPluginPath('core');

		self::onInitClass($className, $path);

		if (!$this->_hasStartupMethod($className)) {
			throw new Exception("Not found static start method");
		}

		$className::start();
	} // end onPluginCoreClassStart

	private function _hasStartupMethod($className)
	{
		$methodName = 'start';
		$method = array($className, $methodName);

		return is_callable($method);
	} // end _hasStartupMethod

	private function _getPluginPath($path = '', $fileName = '')
	{
		$path = ($path) ? $path.'/' : '';

		return dirname($this->_pluginMainFile).'/'.$path.$fileName;
	} // end _getPluginPath

	public function getManager($name, $params = array())
	{
		$manager = $this->_getPluginManager($name);

		if (!$manager) {
			$manager = $this->_getFrameworkManager($name);
		}

		if (!$manager) {
			$prefix = $this->_getConfigValue(self::CLASS_NAME_PREFIX_KEY);
			$name = ucfirst($name).ucfirst($prefix).'Manager';
			throw new Exception("Not found manager ".$name);
		}

		$methodName = 'setParams';

		$method = array(&$manager, $methodName);

		if (is_callable($method)) {
			call_user_func_array($method, $params);
		}

		return $manager;
	} // end getManager

	private function _getPluginManager($name)
	{
		$prefix = $this->_getConfigValue(self::CLASS_NAME_PREFIX_KEY);

		$className = ucfirst($name).ucfirst($prefix).'Manager';

		$path = $this->_getPluginPath('core/manager');

		try {
			self::onInitAbstractClass('JTeamAbstractManager');
			self::onInitClass($className, $path);
		} catch(Exception $e) {
			return false;
		}

		return new $className();
	} // end _getPluginManager

	public function _getFrameworkManager($name)
	{
		$prefix = self::FRAMEWORK_PREFIX;

		$className = ucfirst($prefix).ucfirst($name).'Manager';

		try {
			self::onInitAbstractClass('JTeamAbstractManager');
			self::onInitClass($className, JTEAM_MANAGER_PATH);
		} catch(Exception $e) {
			return false;
		}

		return new $className();
	} // end _getFrameworkManager

	public static function getFacade()
	{
		$engineIdent = self::getCurrentEngineIdent();

		$className = self::FRAMEWORK_PREFIX.ucfirst($engineIdent).'Facade';

		self::onInitClass($className, JTEAM_FACADE_PATH);

		return new $className();
	} // end getFacade

	private static function getCurrentEngineIdent()
	{
		return self::WORDPRESS_ENGINE_IDENT;
	} // end getCurrentEngineIdent

	public function getTemplateManager()
	{
		$params = array($this->_pluginMainFile);

		$template = $this->getManager('template', $params);

		return $template;
	} // end getTemplateManager
}