<?php

if (isset($_GET["logout"])) {
	$auth->logout();
	$util->redirectTo($relPath, "./");
}
