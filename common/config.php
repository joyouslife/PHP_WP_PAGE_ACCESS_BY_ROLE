<?php

define('JTEAM_PATH', dirname(__FILE__).'/');
define('JTEAM_MANAGER_PATH', JTEAM_PATH.'manager/');
define('JTEAM_ABSTRACT_PATH', JTEAM_PATH.'abstract/');
define('JTEAM_FACADE_PATH', JTEAM_PATH.'facade/');

/* WP HOOKS */
define('JTEAM_WP_HOOK_ADMIN_MENU', 'admin_menu');

/* JTEAM HOOKS */
$hookName = 'jteam_after_add_new_admin_page_action';
define('JTEAM_HOOK_AFTER_ADD_NEW_ADMIN_PAGE_ACTION', $hookName);
define('JTEAM_WP_HOOK_ADMIN_PRINT_CSS', 'admin_print_styles');
define('JTEAM_WP_HOOK_ADMIN_PAGE_PRINT_CSS', 'admin_print_styles-');
define('JTEAM_WP_HOOK_ADMIN_PRINT_JS', 'admin_print_scripts');
define('JTEAM_WP_HOOK_ADMIN_PAGE_PRINT_JS', 'admin_print_scripts-');

/* JS HANDLES */
define('JTEAM_JS_HANDLE_JQUERY', 'jquery');
define('JTEAM_JS_HANDLE_BOOTSTRAP', 'bootstrap-minified');

/* CSS HANDLES */
define('JTEAM_CSS_HANDLE_BOOTSTRAP', 'bootstrap-minified');