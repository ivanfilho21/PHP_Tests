<?php

$erro = array();
$nome = "";
$email = "";

if (isset($_POST["cadastrar"])) {
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	if (validacao($nome, $email, $senha) == true) {
		inserirUsuario($nome, $email, $senha);
		$sucesso = "Usuário cadastrado com sucesso.";
	}
}

function validacao($nome, $email, $senha)
{
	global $erro;
	$res = true;

	if (empty($nome) == true) {
		$erro["nome"] = "Nome de usuário vazio.";
		$res = false;
	}

	if (empty($email) == true) {
		$erro["email"] = "E-mail vazio.";
		$res = false;
	} else {
		if (pegarUsuario($email) !== false) {
			$erro["email"] = "Este e-mail já existe.";
			$res = false;
		}
	}

	if (strlen($senha) < 6) {
		$erro["senha"] = "Senha deve conter no mínimo 6 caracteres.";
		$res = false;
	}

	return $res;
}