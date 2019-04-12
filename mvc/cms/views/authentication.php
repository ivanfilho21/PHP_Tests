<span>
	<?php foreach ($error as $e) : ?>
		<?php echo $e; ?>
	<?php endforeach; ?>
</span>

<h1><?php echo ($loginMode) ? "Login" : "Register"; ?></h1>

<i class="fas fa-user"></i>

<i class="fas fa-lock"></i>

<form method="POST">
	<label>E-mail:</label>
	<input type="email" name="email" value="">
	<span><?php echo (! empty($error["email"])) ? $error["email"] : ""; ?></span>

	<label>Password:</label>
	<input type="password" name="password" value="">
	<a id="menu-btn" href="#" title="Show Password"><i class="fas fa-eye"></i></a>
	
	<span><?php echo (! empty($error["password"])) ? $error["password"] : ""; ?></span>

	<input type="submit" name="<?php echo ($loginMode) ? 'login' : 'register'; ?>" value="<?php echo ($loginMode) ? 'Login' : 'Register'; ?>">
</form>

<?php if ($loginMode) : ?>

<?php endif; ?>