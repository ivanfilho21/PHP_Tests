<?php
require "config/config.php";

define("INT", "INT");
	define("VARCHAR", "VARCHAR");
	define("COMMA", ", ");

class Database
{
	private $mysqli = null;

	public function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}

	public function getMysqli()
	{
		return $this->mysqli;
	}

	public function setMysqli($mysqli)
	{
		$this->mysqli = $mysqli;
	}
}