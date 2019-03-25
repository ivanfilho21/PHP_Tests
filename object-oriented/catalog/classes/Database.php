<?php
define("DB_TYPE", "mysql");
define("DB_NAME", "blog_admin_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

define("BQ", "`"); #Backquote

class Database
{
	public function __construct()
	{
		#...
		$pdo = $this->getDatabaseConnection();

		$this->createTables();
	}

	private function getDatabaseConnection() {
		$pdo = null;

		try {
			$dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
			$dbUser = DB_USER;
			$dbPass = DB_PASS;

			$this->pdo = new PDO($dsn, $dbUser, $dbPass);
			# echo "Connected to Database."; die();
		} catch(PDOException $e) {
			# echo "<br>Connection failed:<br>" .$e->getMessage(); die();
		}

		return $pdo;
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
		#echo $sql; die();
	}
}