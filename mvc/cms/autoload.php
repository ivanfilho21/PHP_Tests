<?php
spl_autoload_register(function($className) {
	$extension = ".php";
	$paths = array();
	$paths[] = "";
	$paths[] = "controllers/";
	$paths[] = "models/";
	$paths[] = "models/authentication/";
	$paths[] = "models/database/";
	$paths[] = "models/database/dao/";
	$paths[] = "core/";

	$err = "<b>Autoload:</b> Class <b>\"{$className}" .$extension ."\"</b> does not exist in any known paths.<br><br>Known paths:<br>";
	$loaded = false;

	foreach ($paths as $path) {
		$file = $path .$className .$extension;
		$err .= "[." .$path ."]<br>";

		if (file_exists($file)) {
			require $file;
			$loaded = true;
		}
	}
	if (! $loaded) {
		throw new Exception($err, 1);
	}
});