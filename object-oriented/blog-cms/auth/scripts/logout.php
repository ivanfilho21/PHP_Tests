<?php
/*require ROOT_PATH . "/class/auth/Authentication.php";

$auth = new Authentication($dbAdmin);*/

if (isset($_GET["logout"])) {
	$auth->logout();
    header("Location: " . $relPath . "index.php");
}
