<?php

spl_autoload_register(function($className) {
	$folders = array("classes", "classes/database", "classes/database/dao");

	foreach ($folders as $key => $folder) {
		$path = $folder ."/". $className . ".php";

		if (file_exists($path)) {
			require($path);
			break;
		}
	}
});