<?php include "scripts/util.php"; ?>
<?php include "scripts/database.php"; ?>
<?php include "scripts/auth.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>

	<form method="POST">
		<label for="email">E-mail</label>
		<input type="email" name="email" value="">

		<label for="senha">Senha</label>
		<input type="password" name="senha">

		<input type="submit" name="login" value="Acessar Conta">

		<span><?php if (isset($erro["login"])) echo $erro["login"]; ?></span>
	</form>
</body>
</html>