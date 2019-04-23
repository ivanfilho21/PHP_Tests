<?php
require "classes/Usuarios.php";
$usuarios = new Usuarios($db);

$erro = array();
$nome = "";
$email = "";

if (usuarioLogado() == true) {
	redirecionar("area-privada.php");
}

if (isset($_POST["cadastrar"])) {
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	if (validacao($nome, $email, $senha) == true) {
		$usuarios->inserir($nome, $email, $senha);
		$sucesso = "Usuário cadastrado com sucesso.";
	}
} elseif (isset($_POST["login"])) {
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	login($email, $senha);
}

function validacao($nome, $email, $senha)
{
	global $erro, $usuarios;
	$res = true;

	if (empty($nome) == true) {
		$erro["nome"] = "Nome de usuário vazio.";
		$res = false;
	}

	if (empty($email) == true) {
		$erro["email"] = "E-mail vazio.";
		$res = false;
	} else {
		if ($usuarios->emailExiste($email) == true) {
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

function login($email, $senha)
{
	global $erro, $usuarios;
	$usuario = $usuarios->pegar($email, $senha);

	if ($usuario !== false) {
		$_SESSION["sessao-usuario"] = $usuario["id"];

		# redirecionar para area privada
		redirecionar("area-privada.php");
	} else {
		$erro["login"] = "E-mail ou senha incorretos.";
	}
}