<?php
require "class/database/DAO.php";

class UserDAO extends DAO
{
	private $tableName = "users";
	private $columns = array("id", "username", "password");
	private $atts = array(INT . " NOT NULL AUTO_INCREMENT PRIMARY KEY", VARCHAR . "(20) NOT NULL", VARCHAR . "(256) NOT NULL");

	public function __construct() { }

	public function createTable($mysqli)
	{
		$fields = "";
		$size = count($this->columns);

		for ($i = 0; $i < $size; $i++) {
			$fields .= $this->columns[$i] . " " . $this->atts[$i];

			if ($i < $size - 1)
				$fields .= COMMA;
		}

		# Call parent createTable()
		# Obs.: Cannot be the same name as this method 'create()'
		$this->createTableInDatabase($mysqli, $this->tableName, $fields);
	}
	
}