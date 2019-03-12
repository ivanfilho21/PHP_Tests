<?php

require "../class/auth/Authentication.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	# Authentication object
	$auth = new Authentication($dbAdmin);

	# Login
	if (isset($_POST["login"])) {
		$username = formatInput($_POST["username"]);
		$password = formatInput($_POST["password"]);
		$user = new User(0, $username, $password);

		$auth->login($user, false);
	}

	# Register
	if (isset($_POST["register"])) {
		$username = formatInput($_POST["username"]);
		$password = formatInput($_POST["password"]);

		# todo
	}
}

function formatInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}