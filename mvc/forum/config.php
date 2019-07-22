<?php

define("ROOT", getcwd() ."/");
define("VIEW", ROOT ."app/src/mvc/view/");
define("TEMPLATE", ROOT ."app/src/mvc/view/templates/");
define("ENVIRONMENT", "dev");

if (defined("ENVIRONMENT") && ENVIRONMENT === "dev") {
    define("DB_TYPE", "mysql");
    define("DB_NAME", "forum_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("URL", "http://localhost/dev/php-tests/mvc/forum/");
    define("REL_PAGES", "http://localhost/dev/php-tests/mvc/forum/app/src/pages/");
    define("SITE_NAME", "Forum - [DEV MODE]");
} else {
    define("SITE_NAME", "Forum");
}

require "app/src/packages/wilkins/composer-file-loader/src/PackageLoader.php";

$loader = new \Wilkins\PackageLoader\PackageLoader();
$loader->load(ROOT ."app/src");

# Database Admin object
$dba = \App\Database\DBA::getInstance();

# Template Configuration
$template = "default";
$title = "";
$scripts = array();
$styles = array();