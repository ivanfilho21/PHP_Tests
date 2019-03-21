<?php $relPath = ""; ?>
<?php $pageTitle = "Home Page"; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "index"; ?>
<?php $pageDescription = "Login System is a simple Web Application to register and login users."; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<section class="sub-header">
	Login System is a PHP Web Application that allows you to <a href="auth/register.php">create an account</a> and <a href="auth/login.php">Login</a>.

	If you forgot your password, you can easily <a href="auth/password-recovery.php">reset it</a>.
</section>

<section class="main">
	<h1 class="title">Used Technologies</h1>
	
	<div class="card-holder">
		<div class="card">
			<h3>PHP 7</h3>
			<p>PHP is a popular general-purpose scripting language that is especially suited to web development.</p>
		</div>

		<div class="card">
			<h3>MySQL</h3>
			<p>MySQL is an open-source relational database management system.</p>
		</div>

		<div class="card card-sublime">
			<h3>Sublime Text</h3>
			<p>Sublime Text is a proprietary cross-platform source code editor with a Python application programming interface.</p>
		</div>
	</div>
</section>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>