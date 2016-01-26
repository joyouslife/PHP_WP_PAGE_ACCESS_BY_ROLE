<?php
namespace jteam;

use jteam\app\App;

class JTeam
{
	public function __construct()
	{
		require_once 'autoload.php';
	} // end __construct

	public function app($config)
	{
		if (!class_exists('App')) {
			require_once 'app/App.php';
		}

		return new App($config);
	}
}