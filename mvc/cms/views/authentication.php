<span>
	<?php foreach ($error as $e) : ?>
		<?php echo $e; ?>
	<?php endforeach; ?>
</span>

<div class="container">
	<h1><?php echo ($loginMode) ? "Login" : "Register"; ?></h1>

	<form method="POST">
		<div class="input-group">
			<i class="fas fa-user item"></i>
			<input class="item" type="email" name="email" value="<?php echo (! empty($_POST['email'])) ? $_POST['email'] : ''; ?>" placeholder="E-mail">
		</div>
		<span class="error"><?php echo (! empty($error["email"])) ? $error["email"] : ""; ?></span>
		
		<div class="input-group">
			<i class="fas fa-lock item"></i>
			<input class="item" type="password" name="password" placeholder="Password">
			<a id="menu-btn" class="item" href="#" title="Show Password"><i class="fas fa-eye"></i></a>
		</div>
		<span class="error"><?php echo (! empty($error["password"])) ? $error["password"] : ""; ?></span>

		<div class="error"><?php echo (! empty($error["login"])) ? $error["login"] : ""; ?></div>

		<input type="submit" name="<?php echo ($loginMode) ? 'login' : 'register'; ?>" value="<?php echo ($loginMode) ? 'Login' : 'Register'; ?>">
	</form>
</div>

<script>
	var inputs = document.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].onfocus = function() { this.parentElement.classList.add("active"); }
		inputs[i].onblur = function() { this.parentElement.classList.remove("active"); }
	}
</script>

<?php if ($loginMode) : ?>

<?php endif; ?>