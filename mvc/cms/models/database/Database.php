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
		$this->siteConfig = new SiteConfiguration($this->pdo);
		$this->menu = new Menu($this->pdo);
		$this->pages = new Pages($this->pdo);
		$this->users = new Users($this->pdo);

		
		#$this->siteConfig->create();
		#$this->menu->create();
		#$this->pages->create();
		#$this->users->create();
		

		/*$a = array("title" => "Blog CMS", "color" => "blue", "template" => "default", "home_banner" => "banner.jpg", "home_welcome" => "Welcome to my Blog");
		$this->siteConfig->drop();
		$this->siteConfig->create();
		$this->siteConfig->insert($a);*/

		#$this->menu->drop();
		#$this->menu->create();
		#$a = array("name" => "Home", "url" => "home");
		#$b = array("name" => "Posts", "url" => "posts");
		#$c = array("name" => "About", "url" => "about");
		#$this->menu->insert($a);
		#$this->menu->insert($b);
		#$this->menu->insert($c);

		#$this->pages->drop();
		#$this->pages->create();
		#$this->pages->insert(array("url" => "posts", "title" => "Posts", "body" => ""));
		#$this->pages->insert(array("url" => "about", "title" => "About", "body" => ""));
		
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