<?php

if (isset($_GET["logout"])) {
	$auth->logout();
    header("Location: " . $relPath . "index.php");
}
