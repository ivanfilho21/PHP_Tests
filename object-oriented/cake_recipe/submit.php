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
	$a["recipe_name"] = formatInput($_POST["name"]);
	$a["recipe"] = formatInput($_POST["recipe"]);

	$cakeDB->insert($a);
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