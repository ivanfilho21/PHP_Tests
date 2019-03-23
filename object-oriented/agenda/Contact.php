<?php
define("DB_TYPE", "mysql");
define("DB_NAME", "blog_admin_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

class Contact
{
	private $db;

	public function __construct()
	{
		$dsn = DB_TYPE . ":dbname=" . DB_NAME . ";host=" . DB_HOST;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

		$this->db = new PDO($dsn, $dbUser, $dbPass);
		# echo "Connected to Database.";
	}

	public function add($email, $name = "")
	{
		# check if email exists
		# add only if false

		if (! $this->emailExists()) {
			$sql = "INSERT INTO contacts (name, email) VALUES (:name, :email)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":name", $name);
			$sql->bindValue(":email", $email);
			$sql->execute();

			return true;
		}
		return false;
	}

	public function getName($email)
	{
		$sql = "SELECT name FROM contacts WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bind(":email", $email);
		$res = $sql->execute();

		if ($res->rowCount() > 0) {
			$info = $res->fetch();

			return $info["name"];
		}
		return "";
	}

	public function getAll()
	{
		$sql = "SELECT * FROM contacts";
		$res = $this->db->query($sql);

		if ($res->rowCount() > 0) {
			return $res->fetchAll();
		}
		return array();
	}

	private function emailExists()
	{
		
	}
}