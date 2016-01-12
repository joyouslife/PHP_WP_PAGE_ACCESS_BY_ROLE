<?php

abstract class JTeamAbstractPlugin
{
	protected $mainController;
	protected $mainPluginFile;
	protected $facade;

	protected function __construct($mainPluginFile)
	{
		$this->mainPluginFile = $mainPluginFile;

		$this->mainController = JTeamController::getInstance(
			$this->mainPluginFile
		);

		$this->facade = JTeamController::getFacade();

		$this->onInit();
	} // end __construct

	protected function addActionListener(
		$hook, $methodName, $pirority = 10, $paramsCount = 1
	)
	{
		$method = array(&$this, $methodName);

		$this->facade->addAction($hook, $method, $pirority, $paramsCount);
	} // end addActionListener

	protected function addFilterListener(
		$hook, $methodName, $pirority = 10, $paramsCount = 1
	)
	{
		$method = array(&$this, $methodName);

		$this->facade->addFilter($hook, $method, $pirority, $paramsCount);
	} // end addFilterListener

}