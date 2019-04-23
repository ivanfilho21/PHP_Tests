<?php $titulo = "Cadastro"; ?>
<?php $estiloAdicional = "auth"; ?>
<?php $topo = false; ?>
<?php require "template/topo.php"; ?>
<?php require "auth.php"; ?>
<div class="container">
	<h1 class="titulo"><a href="index.php">Sistema de Login</a></h1>
	
	<form method="POST">
		<label for="nome">Nome</label>
		<input type="text" name="nome" value="<?php echo $nome; ?>">
		<?php if (isset($erro["nome"])) : ?>
			<span class="erro"><?php echo $erro["nome"]; ?></span>
		<?php endif; ?>

		<label for="email">E-mail</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
		<?php if (isset($erro["email"])) : ?>
			<span class="erro"><?php echo $erro["email"]; ?></span>
		<?php endif; ?>

		<label for="senha">Senha</label>
		<input type="password" name="senha">
		<?php if (isset($erro["senha"])) : ?>
			<span class="erro"><?php echo $erro["senha"]; ?></span>
		<?php endif; ?>

		<input type="submit" name="cadastrar" value="Finalizar Cadastro">
	</form>

	<div>
		<?php if (isset($sucesso)) : ?>
			<p><?php echo $sucesso; ?><a href="login.php">Fazer Login</a></p>
		<?php endif; ?>
	</div>

	<hr>
	<a class="link" href="login.php">Acessar minha Conta</a>
</div>
<?php require "template/rodape.php"; ?>