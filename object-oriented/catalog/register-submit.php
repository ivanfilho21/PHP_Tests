<?php
$util = new Util();
$users = $database->getUsersTable();
$showWarning = false;

if ($util->checkMethod("POST")) {
	$name = $util->formatHTMLInput($_POST["name"]);
	$email = $util->formatHTMLInput($_POST["email"]);
	$password = $util->formatHTMLInput($_POST["password"]);
	$passRepeat = $util->formatHTMLInput($_POST["password-repeat"]);

	if (passwordValidation($password, $passRepeat)) {
		$user->register($name, $email, $password, $phone);
	}
	else {
		$showWarning = true;
	}
}

function passwordValidation($pass1, $pass2)
{
	global $util;
	$res = true;

	if (strlen($pass1) < 6) {
		$util->setErrorMessage("password1", "This password is too short.");
		$res = false;
	}
	if (strlen($pass2) < 6) {
		$util->setErrorMessage("password2", "This password is too short.");
		$res = false;
	}
	if ($res) {
		if ($pass1 !== $pass2) {
			$util->setErrorMessage("password2", "Passwords don't match.");
			$res = false;
		}
	}

	return $res;
}