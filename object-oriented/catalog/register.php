<?php require "pages/header.php"; ?>
<?php require "register-submit.php"; ?>

<div class="card">
	<h1>Register</h1>

	<form method="post">
		<?php if ($showWarning) : ?>
			<div class="alert alert-warning">
				<?php $util->getErrorMessage("warning"); ?>
			</div>
		<?php endif; ?>

		<input type="text" required name="name" placeholder="Name" value="<?php echo (isset($name)) ? $name : ''; ?>">
		<input type="email" name="email" placeholder="E-mail" value="<?php echo (isset($email)) ? $email : ''; ?>">
		<input type="text" name="phone" placeholder="Phone number" value="<?php echo (isset($phone)) ? $phone : ''; ?>">

		<input type="password" required name="password" placeholder="Password">
		<span class="error"><?php echo $util->getErrorMessage("password1"); ?></span>

		<input type="password" required name="password-repeat" placeholder="Repeat the password">
		<span class="error"><?php echo $util->getErrorMessage("password2"); ?></span>

		<input type="submit" name="register" value="Register" class="btn btn-default">
	</form>
</div>

<?php require "pages/footer.php"; ?>