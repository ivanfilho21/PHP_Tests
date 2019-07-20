<?php

define("ROOTPATH", getcwd() ."/");
define("ENVIRONMENT", "dev");

if (ENVIRONMENT === "dev") {
    define("DB_TYPE", "mysql");
    define("DB_NAME", "forum_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
}

require "PackageLoader.php";

$loader = new \PackageLoader\PackageLoader();
$loader->load(ROOTPATH ."App/src");

# Database Admin object
$dba = \App\Database\DBA::getInstance();