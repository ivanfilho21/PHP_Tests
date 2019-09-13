<?php

session_start();

require "src/class/DB.php";

$conn = DB::getConnection();



# Util functions

function redirect(String $url)
{
	$url .= (strpos(".php", $url) === false) ? ".php" : "";
	header("Location: " .$url);
	exit();
}