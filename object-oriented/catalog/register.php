<?php require "pages/header.php"; ?>
<?php require "login-script.php"; ?>

<div class="card">
	<h1>Register</h1>

	<?php #$finished = true; ?>
	<?php if ($finished) : ?>
		<div class="alert alert-success">
			Account created successfully.
			<a href="login.php">Login here</a>.
		</div>
	<?php else : ?>
		<form method="post">
			<?php if (count($util->getErrorMessageArray()) > 0) : ?>
				<div class="alert alert-warning">
					<?php foreach ($util->getErrorMessageArray() as $error) : ?>
						<?php echo $error; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<input type="text" required name="name" placeholder="Name" value="<?php echo (isset($name)) ? $name : ''; ?>">
			<input type="email" required name="email" placeholder="E-mail" value="<?php echo (isset($email)) ? $email : ''; ?>">
			<input type="text" name="phone" placeholder="Phone number" value="<?php echo (isset($phone)) ? $phone : ''; ?>">
			<input type="password" required name="password" placeholder="Password">
			<input type="password" required name="password-repeat" placeholder="Repeat the password">

			<input type="submit" name="register" value="Register" class="btn btn-default">
		</form>
	<?php endif; ?>
</div>

<?php require "pages/footer.php"; ?>