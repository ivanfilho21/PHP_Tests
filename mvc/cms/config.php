<?php
#define("ENVIRONMENT", "production");
define("ENVIRONMENT", "development");
#define("DEBUG", true);
#define("DEBUG", false);

if (ENVIRONMENT == "development") {
	#define("BASE_URL", "http://localhost/dev/php-tests/mvc/cms/");
	define("BASE_URL", "http://dev-php.pc/mvc/cms/");
	define("DB_NAME", "blog_db");
	define("DB_HOST", "127.0.0.1");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_TYPE", "mysql");
}
else {
	define("BASE_URL", "https://ivanfilho21.000webhostapp.com/mvc/cms/");
	define("DB_NAME", "id3272628_tasks");
	define("DB_HOST", "localhost");
	define("DB_USER", "id3272628_ivanfilho21");
	define("DB_PASS", "taskdb");
	define("DB_TYPE", "mysql");
}

global $database;
try {
	$database = new Database();
	define("EXCEPTION", false);
} catch(Exception $e) {
	define("EXCEPTION", true);
}

function redirect($relPath)
{
	?>
	<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>" data-relpath="<?php echo $relPath; ?>">
	<script>
		var baseUrl = document.getElementById("data").getAttribute("data-base-url");
		var path = document.getElementById("data").getAttribute("data-relpath");
		window.location.href = baseUrl + path;
	</script>
	<?php
	exit();
}
/*
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
}*/