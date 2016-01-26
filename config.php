<?php

define('PAGE_ACCESS_BY_ROLE_VERSION', '1.0.0');

/* PATH */
define('PAGE_ACCESS_BY_ROLE_PLUGIN_PATH', dirname(__FILE__).'/');

$file = PAGE_ACCESS_BY_ROLE_PLUGIN_PATH.'plugin.php';
define('PAGE_ACCESS_BY_ROLE_MAIN_FILE', $file);

$path = PAGE_ACCESS_BY_ROLE_PLUGIN_PATH.'common/';
define('PAGE_ACCESS_BY_ROLE_FRAMEWORK_PATH', $path);

$path = PAGE_ACCESS_BY_ROLE_PLUGIN_PATH.'view/';
define('PAGE_ACCESS_BY_ROLE_VIEW_PATH', $path);


/* LOCATION */
define('PAGE_ACCESS_BY_ROLE_LANGUAGE_DOMAIN', 'page_access_by_role');

/* HANDLES */
define('PAGE_ACCESS_BY_ROLE_CSS_HANDLE', 'page-access-by-role-');
define('PAGE_ACCESS_BY_ROLE_JS_HANDLE', 'page-access-by-role-');

