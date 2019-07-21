<?php

define("ROOT", getcwd() ."/");
define("PAGES", ROOT ."App/src/pages/");
define("TEMPLATES", ROOT ."App/src/pages/templates/");
define("ENVIRONMENT", "dev");

if (defined("ENVIRONMENT") && ENVIRONMENT === "dev") {
    define("DB_TYPE", "mysql");
    define("DB_NAME", "forum_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("URL", "http://localhost/dev/php-tests/object-oriented/forum/");
    define("REL_PAGES", "http://localhost/dev/php-tests/object-oriented/forum/App/src/pages/");
    define("SITE_NAME", "Forum - [DEV MODE]");
} else {
    define("SITE_NAME", "Forum");
}

require "PackageLoader.php";

$loader = new \PackageLoader\PackageLoader();
$loader->load(ROOT ."App/src");

# Database Admin object
$dba = \App\Database\DBA::getInstance();

# Template Configuration
$template = "default";
$title = "";
$scripts = array();
$styles = array();