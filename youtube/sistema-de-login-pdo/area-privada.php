<?php $titulo = "Área Privada"; ?>
<?php $estiloAdicional = "index"; ?>
<?php require "template/topo.php"; ?>
<?php
	if (usuarioLogado() == false) {
		redirecionar("login.php");
	}
?>

<section class="main container">
	<h1>Bem vindo a Área Privada</h1>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</section>

<?php require "template/rodape.php"; ?>