<?php session_start(); ?>
<?php $relPath = ""; ?>
<?php $pageTitle = "Home Page"; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "index"; ?>
<?php $pageDescription = "Login System é uma aplicação Web que gerencia login de usuários."; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<section class="sub-header header-bg">
	<?php $lang->get("site-name"); ?>
	<?php $lang->get("home-subheader-a"); ?>
	<a href="auth/register.php"><?php $lang->get("home-subheader-b"); ?></a>
	<?php $lang->get("and"); ?>
	<a href="auth/login.php"><?php $lang->get("login-a"); ?></a>.

	<?php $lang->get("home-subheader-c")?>
	<a href="auth/password-recovery.php"><?php $lang->get("recover-it-f"); ?></a>.
</section>

<section class="main">
	<h1 class="title"><?php $lang->get("used-techs"); ?></h1>
	
	<div class="card-holder">
		<div class="card">
			<h3>PHP 7</h3>
			<p><?php $lang->get("php-d"); ?></p>
		</div>

		<div class="card">
			<h3>MySQL</h3>
			<p><?php $lang->get("mysql-d"); ?></p>
		</div>

		<div class="card card-sublime">
			<h3>Sublime Text</h3>
			<p><?php $lang->get("sublime-d"); ?></p>
		</div>
	</div>
</section>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>