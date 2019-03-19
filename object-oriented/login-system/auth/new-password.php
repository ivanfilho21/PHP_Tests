<?php $relPath = "../"; ?>
<?php $pageTitle = "Registre-se"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>
<?php require "scripts/recovery.php"; ?>

<main class="main-content">
    <section class="login-holder">
        <h1>
        	<?php echo ($passwordChanged) ? "Senha Criada" : "Nova Senha"; ?>
        </h1>

        <?php if (! $passwordChanged) : ?>
	        <form method="post" action="<?php #echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	        	<input type="hidden" name="user-id" value="<?php echo ($user != null) ? $user->getId() : '0'; ?>">

	        	<label><?php echo ($user != null) ? $user->getUsername() : ''; ?>, digite sua nova senha:</label>

	            <input type="password" name="password" placeholder="Senha">
	            <span class="error-msg"><?php Util::showError("register-pass1"); ?></span>

	            <input type="password" name="password-retype" placeholder="Repita a Senha">
	            <span class="error-msg"><?php Util::showError("register-pass2"); ?></span>

	            <div class="error-msg" id="error-auth">
	                <p><?php Util::showError("recovery-password"); ?></p>
	            </div>
	            
	            <input type="submit" name="new-password" value="Criar Senha">
	        </form>
	    <?php else: ?>
	    	<div class="options-link">
	    	    <a href="login.php">Retornar à tela de Login</a>
	    	</div>
	    <?php endif; ?>

	    <div class="options-link">
	        <a href=""></a>
	    </div>
        
    </section>
</main>

<?php require "../template/page-bottom.php"; ?>