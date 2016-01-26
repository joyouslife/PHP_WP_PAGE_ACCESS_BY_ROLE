<?php
/**
 * Plugin Name: Page Access By Role
 * Version: 1.0.0
 * Author: JTeam
 */

try {
	require_once 'config.php';
	require_once PAGE_ACCESS_BY_ROLE_FRAMEWORK_PATH.'init.php';

	$config = array(
		'classPrefix' => 'PageAccessByRole'
	);

	JTeamController::onInitNewInstance(
		PAGE_ACCESS_BY_ROLE_MAIN_FILE,
		$config
	);

	$controller = JTeamController::getInstance(PAGE_ACCESS_BY_ROLE_MAIN_FILE);

	$controller->onPluginCoreClassStart('PageAccessByRole');
} catch(Exception $e) {
	echo $e->getMessage();
	exit();
}
