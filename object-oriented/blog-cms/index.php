<?php $pageTitle = "Home Page"; ?>
<?php $pageDescription = "Blog CMS allows users to easily create and manage their own blog."; ?>
<?php $additionalStyles = array(); ?>
<?php require "template/page-top.php"; ?>
<?php require "class/auth/Authentication.php"; ?>

<!-- Main Content -->

<h1>Simple Blog CMS - Home</h1>

<p>
	<?php $user = Authentication::getLoggedUser(); if (isset($user)) echo "Logged user: " . $user->getUsername(); ?>
</p>

<a href="auth/login.php">Login Here</a>

<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>
