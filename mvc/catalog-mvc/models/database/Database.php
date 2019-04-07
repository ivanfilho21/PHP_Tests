<?php
define("DB_TYPE", "mysql");
define("DB_NAME", "catalog_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

# SQL Types
define("INT", "INT");
define("FLOAT", "FLOAT");
define("VARCHAR", "VARCHAR");
define("TEXT", "TEXT");
define("LONGTEXT", "LONGTEXT");

# Useful characters
define("COMMA", ", ");
define("AND_A", " AND ");
define("BQ", "`"); #Backquote
define("QT", "'"); #Single Quote
define("CL", ":"); #Colon

class Database
{
	public function __construct()
	{
		$this->pdo = $this->getDatabaseConnection();
		$this->users = new Users($this->pdo);
		$this->categories = new Categories($this->pdo);
		$this->announcements = new Announcements($this->pdo);
		$this->announcementImg = new AnnouncementImages($this->pdo);

		#$this->users->create();
		#$this->categories->create();
		#$this->announcements->create();
		#$this->announcementImg->create();

		#$this->categories->insert(array("name" => "Eletronics"));
		#$this->categories->insert(array("name" => "Home"));
		#$this->categories->insert(array("name" => "Health"));
		#$this->categories->insert(array("name" => "Furnitures"));
	}

	public function getUsersTable()
	{
		return $this->users;
	}

	public function getCategoriesTable()
	{
		return $this->categories;
	}

	public function getAnnouncementsTable()
	{
		return $this->announcements;
	}

	public function getAnnouncementImagesTable()
	{
		return $this->announcementImg;
	}

	private function getDatabaseConnection() {
		try {
			$dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
			$dbUser = DB_USER;
			$dbPass = DB_PASS;

			$pdo = new PDO($dsn, $dbUser, $dbPass);
			# echo "Connected to Database."; die();
			return $pdo;
		} catch(PDOException $e) {
			# echo "<br>Connection failed:<br>" .$e->getMessage(); die();
		}

		return null;
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

		$sql = "CREATE TABLE IF NOT EXISTS announcement_images (".
					BQ."id".BQ. " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
					BQ."announcementId".BQ. " INT NOT NULL,".
					BQ."url".BQ. " VARCHAR(200) NOT NULL
				)";
		#echo $sql; die();
	}
}