<!-- Must declare this for files that are not in root folder -->
<?php $relPath = "../"; ?>
<?php $pageTitle = "Registre-se"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/recovery.php"; ?>

<main class="main-content">
    <section class="login-holder">
        <h1>Recuperar Senha</h1>

        <?php if ($recoverySent) : ?>
        	<p>Um link para alterar sua senha será enviada em breve para seu e-mail.</p>

            <div class="TEST_DIV_REMOVE_ME_AFTER_LOCAL_TEST">
                <h2>It's a Secret to Everybody</h2>
                <p>
                    Link:<br>
                    <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                </p>
            </div>
            
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" <?php echo ($recoverySent) ? "style='display: none;'" : ""; ?>>

        	<label>Por favor, digite o e-mail usado para criar sua conta.</label>

            <input type="email" required name="email" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>">

            <div class="error-msg" id="error-auth">
                <p><?php Util::showError("recovery-email"); ?></p>
            </div>

            <input type="submit" name="recovery" value="Recuperar Senha">
        </form>

        <div class="options-link">
            <a id="link-B" href="#">Criar Conta</a>
            <a id="link-A" href="login.php">Login</a>
            <div class="clear-fix"></div>
        </div>     
        
    </section>
</main>


<?php require "../template/page-bottom.php"; ?>