<?php include "scripts/util.php"; ?>
<?php include "scripts/database.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Login</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
	<header>
		<div class="container">
			<div class="logo"><a href="index.php">Sistema de Login</a></div>
			<nav class="menu">
				<ul>
					<?php if (usuarioLogado() == false) : ?>
						<li><a href="login.php">Entrar</a></li>
						<li><a href="cadastro.php">Cadastrar-se</a></li>
					<?php else: ?>
						<li><a href="area-restrita.php">Área Restrita</a></li>
						<li><a href="sair.php">Sair</a></li>
					<?php endif; ?>
				</ul>
			</nav>
			<div class="clear-fix"></div>
		</div>
	</header>

	<section class="container">
		<h2>Sistema feito com PHP e MySQL</h2>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</section>

	<footer>
		<p>© 2019 - Ivan Filho</p>
		<p>Projeto disponível no GitHub</p>
	</footer>
</body>
</html>