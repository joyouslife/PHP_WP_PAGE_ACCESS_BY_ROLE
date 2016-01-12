<?php

class JTeamTemplateManager extends JTeamAbstractManager
{
	private $_pluginMainFile;
	private $_path = false;
	public $template;

	public function __construct()
	{
		parent::__construct();
		$this->template = &$this;
	} // end __construct

	public function setParams($pluginMainFile)
	{
		$this->_pluginMainFile = $pluginMainFile;
	} // end setParams

	public function setPath($path)
	{
		$this->_path = $path;
	} // end setPath

	public function fetch($template, $vars = array())
	{
		if ($vars) {
			extract($vars);
		}

		$template = $this->_getTemplatePath($template);

		ob_start();

		include $template;

		$content = ob_get_clean();

		return $content;
	} // end fetch

	private function _getTemplatePath($fileName = '')
	{
		if (!$this->_path) {
			$this->_path = dirname($this->_pluginMainFile).'/templates/';
		}

		return $this->_path.$fileName;
	} // end _getTemplatePath
}