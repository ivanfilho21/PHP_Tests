<?php session_start(); ?>
<?php require "util.php"; ?>
<?php require "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title><?php echo (! empty($titulo)) ? $titulo ." | " : ""; ?>Sistema de Login com PDO</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/footer.css">
	<?php if (! empty($estiloAdicional)) : ?>
		<link rel="stylesheet" href="assets/css/<?php echo $estiloAdicional; ?>.css">
	<?php endif; ?>
</head>
<body>
	<?php if (isset($topo) == false || $topo == true) : ?>
	<header>
		<div class="container">
			<div class="logo">
				<?php if (usuarioLogado() == false) : ?>
					<a href="index.php">
				<?php else: ?>
					<a href="area-privada.php">
				<?php endif; ?>
				Sistema de Login</a>
			</div>
			<nav class="menu">
				<ul>
					<?php if (usuarioLogado() == false) : ?>
						<li><a href="login.php">Entrar</a></li>
						<li><a href="cadastro.php">Cadastrar-se</a></li>
					<?php else: ?>
						<li><a href="sair.php">Sair</a></li>
					<?php endif; ?>
				</ul>
			</nav>
			<div class="clear-fix"></div>
		</div>
	</header>
	<?php endif; ?>