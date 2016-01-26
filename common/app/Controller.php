<?php
namespace jteam\app;

abstract class Controller
{
	protected $app;

	public function __construct(&$app)
	{
		$this->app = $app;
		$this->app->renderData = array();
	}
}