<?php

require "class/CakeDB.php";
global $db;

try {
	$db = new PDO("mysql:dbname=cake_recipe_db;host=127.0.0.1", "root", "");
    # echo "Connected to Database via PDO<br>"; die();
} catch(PDOException $e) {
    echo "Warning: Failed connecting to database.<br><strong>Returned Error:</strong> " .$e->getMessage() . "<br>";
}

$cakeDB = new CakeDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST); die;
	$a["name"] = formatInput($_POST["name"]);
	$a["recipe"] = formatInput($_POST["recipe"]);

	if (validation($a)) {
		$cakeDB->insert($a);
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