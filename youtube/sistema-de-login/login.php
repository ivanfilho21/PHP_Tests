<?php include "scripts/util.php"; ?>
<?php include "scripts/database.php"; ?>
<?php include "scripts/auth.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
	<div class="container">
		<h1 class="titulo"><a href="index.php">Sistema de Login</a></h1>
		<form method="POST">
			<label for="email">E-mail</label>
			<input type="email" name="email" value="">

			<label for="senha">Senha</label>
			<input type="password" name="senha">

			<input type="submit" name="login" value="Acessar Conta">
			
			<?php if (isset($erro["login"])) : ?>
				<span class="erro erro-login"><?php echo $erro["login"]; ?></span>
			<?php endif; ?>
		</form>

		<hr>
		<a class="link" href="cadastro.php">Criar uma Conta</a>
	</div>
</body>
</html>