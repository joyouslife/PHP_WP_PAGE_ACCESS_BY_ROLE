<?php
namespace jteam\app;

class WpFacade
{
	private $_pluginMainFile;

	public function __construct($pluginMainFile)
	{
		$this->_pluginMainFile = $pluginMainFile;
	} // end __construct

	public function isBackend()
	{
		return defined('WP_BLOG_ADMIN');
	} // end isBackend

	public function isAjax()
	{
		return defined('DOING_AJAX') && DOING_AJAX;
	} // end isAjax

	public function getPluginPath($fileName = '')
	{
		return plugin_dir_path($this->_pluginMainFile).$fileName;
	} // end getPluginPath

	public function isFileExists($path = '')
	{
		return file_exists($path);
	} // end isFileExists

	public function addAction(
		$hook, $method, $pirority = 10, $paramsCount = 1
	)
	{
		add_action($hook, $method, $pirority, $paramsCount);
	} // end addAction

	public function addFilter(
		$hook, $method, $pirority = 10, $paramsCount = 1
	)
	{
		add_filter($hook, $method, $pirority, $paramsCount);
	} // end addFilter
}