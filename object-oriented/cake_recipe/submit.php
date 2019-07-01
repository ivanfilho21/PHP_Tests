<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$a["user"] = formatInput($_POST["user"]);
	$a["ing"] = formatInput($_POST["ingredient"]);
	$a["amount"] = formatInput($_POST["amount"]);

	if (validation($a)) {
		save($a);
	}
}
header("Location: index.html");
die;

function formatInput($input)
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

function validation($a)
{
	$res = true;

	if (empty($a["user"])) {
		$res = false;
	}

	return $res;
}