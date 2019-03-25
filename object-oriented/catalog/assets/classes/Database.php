<?php

define("BQ", "`");

class Database
{
	public function __construct()
	{
		#...
		$db = null;

		$this->createTables();
	}

	private function createTables()
	{
		$sql = "CREATE TABLE IF NOT EXISTS users (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(100) NOT NULL,
					email VARCHAR(100) NOT NULL,
					password VARCHAR(32) NOT NULL,
					phone VARCHAR(30)
				)";

		$sql = "CREATE TABLE IF NOT EXISTS categories (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(100) NOT NULL
				)";

		$sql = "CREATE TABLE IF NOT EXISTS announcements (".
					BQ."id".BQ. " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
					BQ."userId".BQ. " INT NOT NULL,".
					BQ."categoryId".BQ. " INT NOT NULL,".
					BQ."title".BQ. " VARCHAR(100),".
					BQ."description".BQ. " VARCHAR(100),".
					BQ."price".BQ. " FLOAT,".
					BQ."condition".BQ. " INT
				)";
		echo $sql; die();
	}
}