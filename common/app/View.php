<?php

namespace jteam\app;

class View
{
	public $app;
	protected $data = array();

	public function __construct(&$app)
	{
		$this->app = $app;

		$this->data = &$this->app->renderData;
	} // end __construct

	public function render($template, $vars = array())
	{
		if ($vars) {
			$this->data($vars);
		}

		$template = $this->_getPath($template);

		ob_start();

		include $template;

		$content = ob_get_clean();

		return $content;
	} // end render

	private function _getPath($file = '')
	{
		return $this->app->facade->getPluginPath('view/'.$file);
	} // end _getPath

	public function backend($template, $vars = array())
	{
		return $this->render('backend/'.$template, $vars);
	} // end backend

	public function frontend($template, $vars = array())
	{
		return $this->render('frontend/'.$template, $vars);
	} // end frontend

	public function data($key, $value = '')
	{
		if (is_array($key)) {
			$this->data = $key;
		} elseif(!$value) {
			$this->data[] = $key;
		} else {
			$this->data[$key] = $value;
		}

		return true;
	} // end data
}
