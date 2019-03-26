<?php
$util = new Util();
$usersTable = $database->getUsersTable();

if ($util->checkMethod("POST")) {
	$name = $util->formatHTMLInput($_POST["name"]);
	$email = $util->formatHTMLInput($_POST["email"]);
	$password = $util->formatHTMLInput($_POST["password"]);
	$passRepeat = $util->formatHTMLInput($_POST["password-repeat"]);
	$phone = $util->formatHTMLInput($_POST["phone"]);

	if (passwordValidation($password, $passRepeat)) {
		$userArray = array("name" => $name, "email" => $email, "password" => md5($password), "phone" => $phone);
		if ($usersTable->register($userArray)) {

		}
		else {
			$util->setErrorMessage("warning", "E-mail \"" .$email ."\" has already been registered.");
		}
	}
}

function passwordValidation($pass1, $pass2)
{
	global $util;
	$res = true;

	if (strlen($pass1) < 6 || strlen($pass2) < 6) {
		$util->setErrorMessage("password", "Your password is too short. The minimum length is 6.");
		$res = false;
	}
	elseif ($pass1 !== $pass2) {
		$util->setErrorMessage("password", "Passwords don't match.");
		$res = false;
	}

	return $res;
}