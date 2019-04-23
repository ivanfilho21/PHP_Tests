<?php
$dbusuario = "root";
$dbsenha = "";
$dbnome = "sistema_login_db";
$dbhost = "127.0.0.1";

global $db;

$dsn = "mysql:dbname=" .$dbnome .";host=" .$dbhost;
$db = new PDO($dsn, $dbusuario, $dbsenha);