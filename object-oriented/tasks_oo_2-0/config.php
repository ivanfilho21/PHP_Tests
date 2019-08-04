<?php

define("ENVIRONMENT", "dev");
define("DEBUGGING", true);
define("DB_TYPE", "mysql");
define("BASE", __DIR__ ."/");
define("BASE_URL", "http://localhost/dev/php-tests/object-oriented/tasks_oo_2-0/");

// echo BASE; die;

if (defined("ENVIRONMENT") && ENVIRONMENT == "dev") {
    define("DB_NAME", "tasks");
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
} else {
    define("DB_HOST", "sql213.epizy.com");
    define("DB_NAME", "epiz_23646966_tasks_db");
    define("DB_USER", "epiz_23646966");
    define("DB_PASS", "ntFMNPatQ5EG");
}

if (defined("DEBUGGING") && DEBUGGING) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(E_STRICT);
}

# Database Connection
$dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
$dbuser = DB_USER;
$dbpass = DB_PASS;

global $db;

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    # echo "Connected to Database via PDO<br>"; die();
} catch(PDOException $e) {
    echo "Warning: Failed connecting to database.<br><strong>Returned Error:</strong> " .$e->getMessage() . "<br>";
}

# Head variables
$relPath = "";
$stylesheets = array();
$scripts = array();