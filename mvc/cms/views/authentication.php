<div class="form-wrapper">
	<img src="<?php echo BASE_URL; ?>assets/img/logo.svg">
	<h1><?php echo ($loginMode) ? "Login" : "Register"; ?></h1>

	<?php if ($registerFinished) : ?>
		<h4>You are now registered. Login <a href="<?php echo BASE_URL; ?>panel/login">here</a>.</h4>
	<?php else : ?>
		<form method="POST">
			<?php if (! $loginMode) : ?>
				<div class="input-group">
					<span><i class="fas fa-user"></i></span>
					<input type="text" name="name" value="<?php echo (! empty($_POST['name'])) ? $_POST['name'] : ''; ?>" placeholder="Name">
				</div>
			<?php endif; ?>

			<div class="input-group">
				<span><i class="fas fa-envelope"></i></span>
				<input type="email" name="email" value="<?php echo (! empty($_POST['email'])) ? $_POST['email'] : ''; ?>" placeholder="E-mail">
			</div>

			<?php if (! empty($error["email"])) : ?>
				<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["email"]; ?></span>
			<?php endif; ?>
			
			<div class="input-group">
				<span><i class="fas fa-lock"></i></span>
				<input type="password" name="password" id="pass" placeholder="Password">
				<a id="show-pass-btn" href="javascript: void(0)" title="Show Password"><i class="fas fa-eye"></i></a>
			</div>
			<?php if (! empty($error["password"])) : ?>
				<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["password"]; ?></span>
			<?php endif; ?>

			<?php if ($loginMode) : ?>
				<div class="login-options">
					<label class="option" for="keep-session"><input type="checkbox" name="keep-session" id="keep-session" <?php echo (! empty($_POST["keep-session"])) ? "checked" : ""?>> Remember me</label>

					<a href="#" class="option">Forgot your password?</a>
				</div>
				
			<?php endif; ?>

			<?php if (! empty($error["login"])) : ?>
				<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["login"]; ?></span>
			<?php endif; ?>

			<input class="btn auth-btn" type="submit" name="<?php echo ($loginMode) ? 'login' : 'register'; ?>" value="<?php echo ($loginMode) ? 'Login' : 'Register'; ?>">
		</form>

		<hr>
		<a href="<?php echo BASE_URL .'panel/'; echo (! $loginMode) ? 'login' : 'register'; ?>"><?php echo (! $loginMode) ? 'I already have an Account' : 'Create an Account'; ?></a>

	<?php endif; ?>
</div>

<script>
	var inputs = document.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].onfocus = function() { this.parentElement.classList.add("active"); }
		inputs[i].onblur = function() { this.parentElement.classList.remove("active"); }
	}

	document.getElementById("show-pass-btn").onclick = function() {
		var pass = document.getElementById("pass");
		if (pass.type == "password") {
			this.innerHTML = "<i class=\"fas fa-eye-slash\"></i>";
			this.title = "Hide Password";
			pass.type = "text";
		} else {
			this.innerHTML = "<i class=\"fas fa-eye\"></i>";
			this.title = "Show Password";
			pass.type = "password";
		}
	};
</script>