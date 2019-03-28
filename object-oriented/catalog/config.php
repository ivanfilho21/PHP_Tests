<?php
session_start();

define("ANNOUNCEMENT_PICTURES_DIR", "assets/images/announcements");

require "autoload.php";

#globaL $database;
$database = new Database();

function checkUserPermissionToPage()
{
	if (empty (getUserSession())) {
		?>
		<script>
			window.location.href = "./";
		</script>
		<?php
		exit();
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