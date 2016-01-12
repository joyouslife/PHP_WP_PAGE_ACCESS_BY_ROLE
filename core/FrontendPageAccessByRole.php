<?php

class FrontendPageAccessByRole extends PageAccessByRole
{
	private static $_instance = NULL;

	protected function onInit()
	{
		echo 'test';
	} // end onInit

	public static function getInstance()
	{
		if (!self::$_instance) {
			throw new Exception("Instance did not start, use method start");
		}

		return self::$_instance;
	} // end getInstance

	public static function start()
	{
		if (self::$_instance) {
			throw new Exception("Instance started, use method getInstance");
		}

		self::$_instance = new self(PAGE_ACCESS_BY_ROLE_MAIN_FILE);
	} // end start
}