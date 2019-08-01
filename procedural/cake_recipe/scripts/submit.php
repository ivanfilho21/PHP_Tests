<?php

require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$a["recipe_name"] = formatInput($_POST["name"]);
	$a["recipe"] = formatInput($_POST["recipe"]);

	$cakeDB->insert($a);
}
header("Location: ../index.html");
die;

function formatInput($input)
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}