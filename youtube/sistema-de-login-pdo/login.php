<?php $titulo = "Login"; ?>
<?php $estiloAdicional = "auth"; ?>
<?php $topo = false; ?>
<?php require "template/topo.php"; ?>
<?php require "auth.php"; ?>

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

<?php require "template/rodape.php"; ?>