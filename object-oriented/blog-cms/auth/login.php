<?php require "../main.php"; ?>
<?php require "authentication.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>

	<meta name="viewport" content="width=display-width, initial-scale=1">
</head>
<body>
	<form method="POST" action="">
		<fieldset>
			<legend>Login to your Account</legend>

			<input type="email" name="email">
			<input type="password" name="password">

			<input type="submit" name="login" value="Login">
		</fieldset>
	</form>
</body>
</html>