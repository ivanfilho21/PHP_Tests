<?php

$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPass = "";
$dbName = "sistema_login_db";

$db = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (mysqli_connect_errno($db)) {
	echo "Falha ao conectar-se ao Banco de Dados.";
	exit();
}
#echo "Conectado ao Banco de Dados";

criarTabelaUsuarios($db);

# Funções
function criarTabelaUsuarios()
{
	global $db;
	$tabela = "`usuarios`";
	$sql = "CREATE TABLE IF NOT EXISTS " .$tabela ." (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`senha` VARCHAR(32) NOT NULL
	)";

	#echo $sql; die();
	$res = mysqli_query($db, $sql);
	
	if ($res == false) {
		echo mysqli_error($db);
	}
}

function inserirUsuario($nome, $email, $senha)
{
	global $db;
	$tabela = "`usuarios`";
	$sql = "INSERT INTO " .$tabela ." (`nome`, `email`, `senha`) VALUES (
	'" .$nome ."', '" .$email ."', '" .md5($senha) ."')";

	#echo $sql; die();
	$res = mysqli_query($db, $sql);
	
	if ($res == false) {
		echo mysqli_error($db);
	}
}

function pegarUsuario($email)
{
	global $db;
	$tabela = "`usuarios`";
	$sql = "SELECT * FROM " .$tabela ." WHERE `email` = '" .$email ."'";

	$res = mysqli_query($db, $sql);

	if ($res == false) {
		echo mysqli_error($db);
		return $res;
	}

	while ($a = mysqli_fetch_assoc($res)) {
		return $a;
	}
}