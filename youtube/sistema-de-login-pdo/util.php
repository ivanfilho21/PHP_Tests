<?php
function usuarioLogado()
{
	if (isset($_SESSION["sessao-usuario"])) {
		return true;
	}
	return false;
}

function redirecionar($pagina="index.php")
{
	#header("Location: " .$pagina);
	?>
	<div id="data" data-link="<?php echo $pagina; ?>"></div>
	<script>
		var endereco = document.getElementById("data").getAttribute("data-link");
		window.location.href = endereco;
	</script>
	<?php
	exit();
}