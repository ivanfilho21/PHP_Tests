<?php require "pages/header.php"; ?>

<div class="card">
	<h1>Register</h1>

	<form method="post">
		<input type="text" name="name" placeholder="Name">
		<input type="email" name="email" placeholder="E-mail">
		<input type="text" name="phone" placeholder="Phone number">

		<input type="password" name="password" placeholder="Password">
		<input type="password" name="password-repeat" placeholder="Repeat the password">

		<input type="submit" name="register" class="btn btn-default">
	</form>
</div>

<?php require "pages/footer.php"; ?>