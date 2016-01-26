<?php

class PageAccessByRoleController
{
	const CLASS_PREFIX = 'PageAccessByRole';

	public static function onInitCoreClass($className, $fullName = false)
	{
		if (!$fullName) {
			$className = self::CLASS_PREFIX.ucfirst($className);
		}

		self::onInitClass($className, PAGE_ACCESS_BY_ROLE_CORE_PATH);
	} // end onInitCoreClass

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
}