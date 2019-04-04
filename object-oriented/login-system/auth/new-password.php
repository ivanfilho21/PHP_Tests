<?php session_start(); ?>
<?php $relPath = "../"; ?>
<?php $pageTitle = "Alterar Senha"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>
<?php require "scripts/password-reset.php"; ?>

<main class="main">
    <section class="login-holder">
    	<?php if (! $requestExpired) : ?>
	        <h1>
	        	<?php echo ($passwordChanged) ? "Senha Criada" : "Nova Senha"; ?>
	        </h1>
	        
	        <?php if (! $passwordChanged) : ?>
	        <form method="post" action="<?php #echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	        	<input type="hidden" name="selector" value="<?php echo $selector; ?>">
	        	<input type="hidden" name="validator" value="<?php echo $validator; ?>">

	        	<label>Digite uma nova senha:</label>

	            <input type="password" name="password" placeholder="Senha" autofocus>
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
	    <?php else : ?>
	    	<h1>Requisição Expirada</h1>

	    	<div class="options-link">
	    	    <a href="login.php">Retornar à tela de Login</a>
	    	</div>
	    <?php endif; ?>        
    </section>
</main>

<?php require "../template/page-bottom.php"; ?>