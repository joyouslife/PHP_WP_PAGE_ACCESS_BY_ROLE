<?php

class JTeamAbstractView
{
	protected $template;

	public function __construct()
	{
		$pluginMainFile = $this->getMainPlugiFile();
		$controller = JTeamController::getInstance($pluginMainFile);
		$this->template = $controller->getTemplateManager();
	} // end __construct

	protected function getMainPlugiFile()
	{
		throw new Exception('Not found method getMainPlugiFile');
	} // end getMainPlugiFile

	public function display()
	{
		echo $this->fetch();
	} // end display

	public function fetch($content = '')
	{
		throw new Exception('Undefined method fetch');
	} // end fetch
}