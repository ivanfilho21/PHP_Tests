<?php
require "class/database/UserDAO.php";

class DatabaseAdmin
{
	private $database = null;
	private $userDAO = null;

	public function __construct()
	{
		$mysqli = new mysqli(DBA_SERVER, DBA_USER, DBA_PASS, DBA_NAME);

		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			die();
		}
		$this->database = new Database($mysqli);

		$this->userDAO = new UserDAO();
		$this->userDAO->createTable($this->database->getMysqli());
	}

	public function getDatabaseAdmin()
	{
		return $this->database;
	}

	public function setDatabaseAdmin($database)
	{
		$this->database = $database;
	}
}