<?php
spl_autoload_register(function($className) {
	$folders = array("controllers/", "core/", "models/");
	$extension = ".php";

	foreach ($folders as $location) {
		if (file_exists($location .$className .$extension)) {
			require $location .$className .$extension;
		}
	}
});