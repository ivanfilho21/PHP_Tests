<?php

use \Wilkins\PackageLoader\PackageLoader;

// define("ROOT", getcwd() ."/");
define("ROOT", __DIR__ ."/");
define("VIEW", ROOT ."app/src/mvc/view/pages/");
define("TEMPLATE", ROOT ."app/src/mvc/view/templates/");
define("ENVIRONMENT", "dev");


if (defined("ENVIRONMENT") && ENVIRONMENT === "dev") {
    define("DB_TYPE", "mysql");
    define("DB_NAME", "forum_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
    // define("URL", "http://localhost/dev/php-tests/mvc/forum/");
    $array = explode("/", $_SERVER["PHP_SELF"]);
    array_shift($array);
    array_pop($array);
    define("URL", $_SERVER["REQUEST_SCHEME"] ."://" .$_SERVER["SERVER_NAME"] ."/" .implode("/", $array) ."/");

    define("ASSETS", URL ."assets/");
    define("REL_TEMPLATE", URL ."forum/app/src/mvc/view/templates/");
    define("REL_PAGE", URL ."app/src/mvc/view/pages/");
    define("SITE_NAME", "Forum - [DEV MODE]");
} else {
    define("SITE_NAME", "Forum");
}

require "app/src/packages/wilkins/composer-file-loader/src/PackageLoader.php";

$loader = new PackageLoader();
$loader->load(ROOT ."app/src");

# Database Admin object
$dba = \App\Database\DBA::getInstance();

# Template Configuration
$template = "default";
$title = "";
$scripts = array();
$styles = array();