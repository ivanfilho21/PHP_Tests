<?php

define("DB_NAME", "tasks_db");
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

# Head variables
$stylesheets = array();