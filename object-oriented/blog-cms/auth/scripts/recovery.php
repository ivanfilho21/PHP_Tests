<?php

if (isset($_GET["password-recovery"])) {
	$newPass = $util->formatHTMLInput($_GET["password"])
	$auth->changePassword($newPass);
    header("Location: " . $relPath . "index.php");
}
