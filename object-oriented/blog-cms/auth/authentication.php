<?php

# Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	# echo "ok";
	$auth = new Authentication($dbAdmin);
	$auth->login(new User(0, "admin", "123"));
}

# Register

class Authentication
{
	private $dbAdmin;

	public function __construct($dbAdmin)
	{
		$this->dbAdmin = $dbAdmin;
	}

	public function login($user)
	{
		$cols = array("username", "password");
		$cols = DatabaseUtils::getTableFields($this->dbAdmin->getUserDAO(), false);
		$this->dbAdmin->getUserDAO()->select($cols);
	}

	# Returns true if the user exists in the database, false otherwise.
	private function checkLogin($user)
	{
		/*$sql = "SELECT * FROM {$usersTable} WHERE username = '{$name}' AND password = '{$pass}';";
		
		$res = mysqli_query($connection, $sql);
		
		if ($res == false) return null;

		return mysqli_fetch_assoc($res);*/
	}
}