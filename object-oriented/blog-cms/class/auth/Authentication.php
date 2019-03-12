<?php

class Authentication
{
	private $dbAdmin;

	public function __construct($dbAdmin)
	{
		$this->dbAdmin = $dbAdmin;
	}

	public function login(User $user, bool $keepLogged)
	{
		if ($this->checkLogin($user)) {
			# Do login
			echo "<br>User Logged.";
		} else {
			echo "<br>Wrong username or password.";
		}
	}

	# Returns true if the user exists in the database, false otherwise.
	private function checkLogin($user)
	{
		$tableName = $this->dbAdmin->getUserDAO()->getTableName();
		$sql = "SELECT * FROM " . $tableName . " WHERE " . QT_A . "username" . QT_A . " = " . QT . $user->getUsername() . QT . " AND " . QT_A . "password" . QT_A . " = " . MD5 . "(" . QT . $user->getPassword() . QT . ")";

		echo $sql;

		$res = $this->dbAdmin->getUserDAO()->query($sql);
		echo "rows " . $res->rowCount();
		if ($res->rowCount() == 1) {
			return true;
		}
		return false;
	}
}