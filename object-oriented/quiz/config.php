<?php

session_start();

use \Wilkins\PackageLoader\PackageLoader;
use \App\Database\DBA;

define("DB_TYPE", "mysql");
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "quiz_db");
define("DB_USER", "root");
define("DB_PASS", "");

$db = null;

try {
    $db = new PDO(DB_TYPE .":dbname=" .DB_NAME .";host=" .DB_HOST, DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require "packages/wilkins/composer-file-loader/src/PackageLoader.php";

$loader = new PackageLoader();
$loader->load($relPath ."");

# Database Admin object
$dba = DBA::getInstance();