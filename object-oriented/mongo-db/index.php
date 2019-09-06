<!DOCTYPE html>
<html>
<head>
	<title>Teste com MongoDB</title>
	<style>
		body {
			background: #333;
			color: #eee;
		}
	</style>
</head>
<body>
	<h1>Teste PHP e MongoDB</h1>

	<?php

	require "vendor/autoload.php";

	use MongoDB\Client as MongoDB;

	$conn = new MongoDB("mongodb://localhost:27017");

	$db = $conn->test;
	$megasena = $db->megasena;
	$docs = $megasena->find();

	// echo "<pre>" .print_r($megasena, true) .PHP_EOL; die;
	echo "Database: " .$megasena->getDatabaseName() ."<br>";
	echo "Collection: " .$megasena->getCollectionName() ."<br>";
	echo "Documents: " .$megasena->count();
	echo "<br><br>";

	foreach ($docs as $doc) {
		echo "ID: " .$doc["_id"] .
		" Concurso: " .$doc["Concurso"] .
		" Acumulou: " .$doc["Acumulado"] .
		" Data: " .$doc["Data Sorteio"] .
		"<br>";
	}
	?>
</body>
</html>