<?php
require "class/database/Database.php";

abstract class DAO extends Database
{
	public function __construct() {	}

	protected function createTableInDatabase($mysqli, $name, $fields)
	{
		$sql = "CREATE TABLE IF NOT EXISTS `" . $name . "` (" . $fields . ")";
		# echo $sql;

		$mysqli->query($sql) or die("Error in query \"" . $sql . "\"<br><br>Possible Causes:<br><ul><li>Table Already exists.</li><li>Database does not exist.</li></ul>");
	}
}