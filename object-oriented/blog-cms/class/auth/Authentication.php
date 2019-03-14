<?php

class Authentication
{
	private $dbAdmin;

	public function __construct($dbAdmin)
	{
		$this->dbAdmin = $dbAdmin;
	}

	public function login($username, $password, bool $keepLogged)
	{
		if ($this->checkLogin(new User(0, $username, $password))) {
			session_start();

			$_SESSION["user-session"]["username"] = $username;
			$_SESSION["user-session"]["password"] = $password;

			return true;

			# Do login
			# echo "<br>User Logged.";
		} else {
			# echo "<br>Wrong username or password.";
			return false;
		}
	}

	public function getLoggedUser()
	{
		if (isset($_SESSION["user-session"])) {
			$name = $_SESSION["user-session"]["username"];
			$pass = $_SESSION["user-session"]["password"];
			$user = new User(0, $name, $pass);

			return $user;
		}
		return null;
	}

	# Returns true if the user exists in the database, false otherwise.
	private function checkLogin($user)
	{
		$tableName = $this->dbAdmin->getUserDAO()->getTableName();
		$sql = "SELECT * FROM " . $tableName . " WHERE " . QT_A . "username" . QT_A . " = " . QT . $user->getUsername() . QT . " AND " . QT_A . "password" . QT_A . " = " . MD5 . "(" . QT . $user->getPassword() . QT . ")";

		# echo $sql;

		$res = $this->dbAdmin->getUserDAO()->query($sql);
		# echo "<br>rows " . $res->rowCount();
		
		if ($res->rowCount() == 1) {
			return true;
		}
		return false;
	}
}