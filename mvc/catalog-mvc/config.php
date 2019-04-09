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
	define("BASE_URL", "https://ivanfilho21.000webhostapp.com/mvc/catalog-mvc/");
	define("DB_NAME", "id3272628_tasks");
	define("DB_HOST", "localhost");
	define("DB_USER", "id3272628_ivanfilho21");
	define("DB_PASS", "taskdb");
	define("DB_TYPE", "mysql");
}

define("ANNOUNCEMENT_PICTURES_DIR", "assets/images/announcements");

global $database;

$database = new Database();

function checkUserPermissionToPage()
{
	if (empty (getUserSession())) {
		?>
		<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
		<script>
			var baseUrl = document.getElementById("data").getAttribute("data-base-url");
			window.location.href = baseUrl;
		</script>
		<?php
	}
}

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