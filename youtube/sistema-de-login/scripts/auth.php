<?php

$erro = array();
$nome = "";
$email = "";

if (usuarioLogado() == true) {
	# redirecionar para area privada
	redirecionar();
}

if (isset($_POST["cadastrar"])) {
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	if (validacao($nome, $email, $senha) == true) {
		inserirUsuario($nome, $email, $senha);
		$sucesso = "Usuário cadastrado com sucesso.";
	}
} elseif (isset($_POST["login"])) {
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	login($email, $senha);
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
		if (emailExiste($email) == true) {
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
	global $erro;
	$usuario = pegarUsuario($email, $senha);

	if ($usuario !== null) {
		$_SESSION["sessao-usuario"] = $usuario["id"];

		# redirecionar para area privada
		redirecionar();
	} else {
		$erro["login"] = "E-mail ou senha incorretos.";
	}
}

function redirecionar()
{
	header("Location: area-privada.php");
	exit();
}