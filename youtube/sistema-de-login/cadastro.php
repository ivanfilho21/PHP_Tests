<?php include "scripts/util.php"; ?>
<?php include "scripts/database.php"; ?>
<?php include "scripts/auth.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro</title>
</head>
<body>
	<h1>Cadastro</h1>

	<form method="POST">
		<label for="nome">Nome</label>
		<input type="text" name="nome" value="<?php echo $nome; ?>">
		<span><?php if (isset($erro["nome"])) echo $erro["nome"]; ?></span>

		<label for="email">E-mail</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
		<span><?php if (isset($erro["email"])) echo $erro["email"]; ?></span>

		<label for="senha">Senha</label>
		<input type="password" name="senha">
		<span><?php if (isset($erro["senha"])) echo $erro["senha"]; ?></span>

		<input type="submit" name="cadastrar" value="Finalizar Cadastro">
	</form>

	<div>
		<?php if (isset($sucesso)) : ?>
			<p><?php echo $sucesso; ?></p>
			<a href="login.php">Fazer Login</a>
		<?php endif; ?>
	</div>
</body>
</html>