<?php
/**
 * Plugin Name: Page By Role
 * Version: 1.0.0
 * Author: JTeam
 */

try {
	require_once 'common/init.php';

	$config = include_once 'config/config.php';

	$config['plugin_main_file'] = __FILE__;

	$jteam->app($config)->run();
} catch (Exception $e) {
	echo $e->getMessage();
	exit();
}