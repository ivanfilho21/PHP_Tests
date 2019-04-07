<?php
#define("ENVIRONMENT", "production");
define("ENVIRONMENT", "development");
define("DEBUG", "true");
$config = array();

if (ENVIRONMENT == "development") {
	define("BASE_URL", "http://localhost/dev/php-tests/mvc/catalog-mvc/");
	$config["dbname"] = "catalog_db";
	$config["host"] = "127.0.0.1";
	$config["dbuser"] = "root";
	$config["dbpass"] = "";
	$config["dbtype"] = "mysql";
}
else {
	define("BASE_URL", "mysite here ");
	$config["dbname"] = "id3272628_auth_db";
	$config["host"] = "localhost";
	$config["dbuser"] = "id3272628_auth_user";
	$config["dbpass"] = "authdb";
	$config["dbtype"] = "mysql";
}

global $db;
try {
	$db = new PDO(
		$config["dbtype"] .":dbname=" .$config["dbname"] .";"
		."host=" .$config["host"],$config["dbuser"],$config["dbpass"]
	);
} catch(PDOException $e) {
	echo "Failed connecting to database. Message: " .$e->getMessage();
	exit();
}