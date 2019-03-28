<?php
session_start();

require "autoload.php";

#globaL $database;
$database = new Database();

function getUserSession()
{
	if (isset($_SESSION["user-session-id"])) {
		return $_SESSION["user-session-id"];
	}
	return "";
}

function setUserSession($value)
{
	$_SESSION["user-session-id"] = $value;
}

function unsetUserSession()
{
	unset($_SESSION["user-session-id"]);
}