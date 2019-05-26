<?php
define("ROOT_PATH", "./");

class IniReader
{
	public function __construct() {}

	public static function parseIniFile($path)
	{
		$file = ROOT_PATH .$path;
		if (file_exists($file)) {
			return parse_ini_file($file);
		}
		return false;
	}
}