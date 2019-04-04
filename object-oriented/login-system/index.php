<?php session_start(); ?>
<?php $relPath = ""; ?>
<?php $pageTitle = "Home Page"; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "index"; ?>
<?php $pageDescription = "Login System é uma aplicação Web que gerencia login de usuários."; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<section class="sub-header header-bg">
	Login System é uma Aplicação Web feita em PHP que permite <a href="auth/register.php">criar uma conta</a> e fazer <a href="auth/login.php">Login</a>.

	Caso você esqueça sua senha, você pode <a href="auth/password-recovery.php">recuperá-la</a> facilmente.
</section>

<section class="main">
	<h1 class="title">Used Technologies</h1>
	
	<div class="card-holder">
		<div class="card">
			<h3>PHP 7</h3>
			<p>PHP é uma popular linguagem de scripting de propósito geral que é especialmente adequada para o desenvolvimento web.</p>
		</div>

		<div class="card">
			<h3>MySQL</h3>
			<p>MySQL é um sistema de gerenciamento de banco de dados relacional open-source.</p>
		</div>

		<div class="card card-sublime">
			<h3>Sublime Text</h3>
			<p>Sublime Text é um editor de código fonte proprietário e multi-plataforma com uma interface feita em Python.</p>
		</div>
	</div>
</section>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>