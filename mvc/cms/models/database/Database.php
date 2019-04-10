<?php
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

class Database extends Model
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
			$dsn = DB_TYPE .":dbname=" .DB_NAME .";host=" .DB_HOST;
			$dbUser = DB_USER;
			$dbPass = DB_PASS;

			$pdo = new PDO($dsn, $dbUser, $dbPass);
			# echo "Connected to Database."; die();
			return $pdo;
		} catch(PDOException $e) {
			if (defined("DEBUG") && DEBUG) {
				echo "<br>Connection failed:<br>" .$e->getMessage(); die();
			}
			throw new Exception("<b>Database</b>: Error connecting to PDO.", 1);
		}

		return null;
	}
}