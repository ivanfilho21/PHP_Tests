<?php require "pages/header.php"; ?>
<?php require "login-script.php"; ?>

<div class="card">
	<h1>Login</h1>

	<form method="post">
		
		<input type="email" required name="email" placeholder="E-mail" value="<?php echo (isset($email)) ? $email : ''; ?>">
		<input type="password" required name="password" placeholder="Password">

		<?php if (count($util->getErrorMessageArray()) > 0) : ?>
			<div class="alert alert-danger">
				<?php foreach ($util->getErrorMessageArray() as $error) : ?>
					<?php echo $error; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<input type="submit" name="login" value="Login" class="btn btn-default">
	</form>
</div>

<?php require "pages/footer.php"; ?>