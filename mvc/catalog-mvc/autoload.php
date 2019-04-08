<?php
spl_autoload_register(function($className) {
	$extension = ".php";
	/*
	$folders = array("controllers/", "core/", "models/");
	

	foreach ($folders as $location) {
		if (file_exists($location .$className .$extension)) {
			require $location .$className .$extension;
		}
	}
	*/

	if (file_exists("controllers/" .$className .$extension)) {
		require "controllers/" .$className .$extension;
	}
	elseif (file_exists("models/" .$className .$extension)) {
		require "models/" .$className .$extension;
	}
	elseif (file_exists("models/database/" .$className .$extension)) {
		require "models/database/" .$className .$extension;
	}
	elseif (file_exists("models/database/dao/" .$className .$extension)) {
		require "models/database/dao/" .$className .$extension;
	}
	elseif (file_exists("core/" .$className .$extension)) {
		require "core/" .$className .$extension;
	}
	else {

		throw new \Exception("Error: class doesn't exist.", 1);
	}
});