<?php
$user = null;
$error_msgs = array();
$fields = array("username", "password");
$name = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["username"];
	$pass = $_POST["password"];

	if (validation($name, $pass))
	{
		if (isset($user))
		{
			$_SESSION["connected_user"] = $user;
			header("Location:index.php");
			exit();
		}
		else
		{
			$error_msgs["login"] = "Wrong username or password.";
		}
	}
}

function validation($name, $pass)
{
	global $connection, $error_msgs, $fields, $user;
	$res = true;
	
	$user = check_login($connection, $name, $pass);
	return $res;
}	
