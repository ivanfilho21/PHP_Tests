<?php
/*require ROOT_PATH . "/class/auth/Authentication.php";

$auth = new Authentication($dbAdmin);*/

if (isset($_GET["logout"])) {
	session_start();
	$_SESSION["user-session"] = null;
	header("Location: " . $relPath . "index.php");
}
