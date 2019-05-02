<?php

define("DB_NAME", "tasks");
define("DB_TYPE", "mysql");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

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