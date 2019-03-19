<?php $relPath = ""; ?>
<?php $pageTitle = "Home Page"; ?>
<?php $pageDescription = "Login System is a simple Web Application to create and login users."; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<h1>Login System - Home</h1>

<p>
	<?php echo ($user != null) ? "Welcome, " . $user->getUsername() . "." : ""; ?>
</p>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>