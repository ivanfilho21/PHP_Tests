<!-- Must declare this for files that are not in root folder -->
<?php $relPath = "../"; ?>
<?php $pageTitle = "Login"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "authentication.php"; ?>

<!-- Main Content -->

<h1>Simple Blog CMS - Login</h1>

<?php # Test # echo dirname(__FILE__) . "/"; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<fieldset>
		<legend>Login to your Account</legend>

		<input type="text" name="username">
		<input type="password" name="password">

		<input type="submit" name="login" value="Login">
	</fieldset>
</form>

<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>