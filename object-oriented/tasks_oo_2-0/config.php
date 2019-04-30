<?php

define("DB_NAME", "tasks");
define("DB_TYPE", "mysql");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");


# Get the current URL
$array = explode("/", $_SERVER["PHP_SELF"]);
array_shift($array);
array_pop($array);
define("URL", $_SERVER["REQUEST_SCHEME"] ."://" .$_SERVER["SERVER_NAME"] ."/" .implode("/", $array) ."/");
define("PATH", __DIR__ ."/");

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
$stylesheets = array();