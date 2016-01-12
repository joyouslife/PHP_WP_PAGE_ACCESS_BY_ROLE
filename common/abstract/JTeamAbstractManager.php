<?php

abstract class JTeamAbstractManager
{
	protected $facade;

	public function __construct()
	{
		$this->facade = JTeamController::getFacade();
	} // end __construct
}