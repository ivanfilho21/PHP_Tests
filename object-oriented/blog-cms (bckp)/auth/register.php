<!-- Must declare this for files that are not in root folder -->
<?php $relPath = "../"; ?>
<?php $pageTitle = "Registre-se"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>

<!-- Main Content -->
<main class="main-content">
    <section class="login-holder">
        <h1>
            <?php echo ($registerFinished) ? "Conta criada com sucesso" : "Registre-se"; ?>
        </h1>

        <span>
            <?php echo ($registerFinished) ? "Em breve um e-mail será enviado com seus dados de acesso." : ""; ?>
        </span>

        <?php if (! $registerFinished) : ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <input type="email" required name="email" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>">

                <span class="error-msg"><?php Util::showError("register-email"); ?></span>

                <input type="text" required name="username" placeholder="Seu nome" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">

                <span class="error-msg"><?php Util::showError("register-username"); ?></span>

                <input type="password" name="password" placeholder="Senha">

                <span class="error-msg"><?php Util::showError("register-pass1"); ?></span>

                <input type="password" name="password-retype" placeholder="Repita a senha">

                <div class="error-msg" id="error-auth">
                    <p><?php Util::showError("register-pass2"); ?></p>
                </div>

                <input type="submit" name="register" value="Criar Conta">
            </form>
        <?php endif; ?>

        <div class="options-link">
            <a id="link-A" href="login.php">Login</a>
            <a id="link-B" href="password-recovery.php">Esqueci a Senha</a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>
<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>