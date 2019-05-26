<?php
require "IniReader.php";

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "pokedex_db";
$dsn = "mysql:dbname=" . $db . ";host=" . $host;

global $pdo;

try {
	$pdo = new PDO($dsn, $user, $pass);
} catch (Exception $e) {
	// echo $e->getMessage();
	echo "<b>Erro na conexão ao banco de dados.<br>Por favor, tente mais tarde.</b>";
	die;
}

// $array = IniReader::parseIniFile("pokemon.ini");
// var_dump($array);