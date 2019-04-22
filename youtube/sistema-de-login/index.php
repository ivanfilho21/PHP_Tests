<?php include "scripts/util.php"; ?>
<?php include "scripts/database.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Login</title>
</head>
<body>
	<nav>
		<ul>
			<?php if (usuarioLogado() == false) : ?>
				<li><a href="cadastro.php">Cadastre-se</a></li>
				<li><a href="login.php">Entrar</a></li>
			<?php else: ?>
				<li><a href="area-restrita.php">Área Restrita</a></li>
				<li><a href="sair.php">Sair</a></li>
			<?php endif; ?>
		</ul>
	</nav>

	<h1>Sistema de Login</h1>

	<h3>Alguma descrição aqui</h3>
</body>
</html>