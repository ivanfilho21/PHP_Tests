<?php
#define("ENVIRONMENT", "production");
define("ENVIRONMENT", "development");
define("DEBUG", "true");

if (ENVIRONMENT == "development") {
	define("BASE_URL", "http://localhost/dev/php-tests/mvc/catalog-mvc/");
	define("DB_NAME", "catalog_db");
	define("DB_HOST", "127.0.0.1");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_TYPE", "mysql");
}
else {
	define("BASE_URL", "mysite here ");
	define("DB_NAME", "id3272628_auth_db");
	define("DB_HOST", "localhost");
	define("DB_USER", "id3272628_auth_user");
	define("DB_PASS", "authdb");
	define("DB_TYPE", "mysql");
}

define("ANNOUNCEMENT_PICTURES_DIR", BASE_URL ."assets/images/announcements");

global $database;

$database = new Database();

function getUserSession()
{
	if (isset($_SESSION["user-session-id"])) {
		return $_SESSION["user-session-id"];
	}
	return "";
}

function setUserSession($value)
{
	$_SESSION["user-session-id"] = $value;
}

function unsetUserSession()
{
	unset($_SESSION["user-session-id"]);
}