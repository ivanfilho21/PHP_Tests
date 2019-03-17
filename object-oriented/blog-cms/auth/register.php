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
            <?php echo ($registerFinished) ? "Usuário criado" : "Registre-se"; ?>
        </h1>

        <span>
            <?php echo ($registerFinished) ? "Você será redirecionado em breve..." : ""; ?>
        </span>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" <?php echo ($registerFinished) ? "style='display: none;'" : ""; ?>>
            <input type="text" required name="username" placeholder="Nome do Usuário" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">

            <span class="error-msg"><?php Util::showError("register-username"); ?></span>

            <input type="password" name="password" placeholder="Senha">

            <span class="error-msg"><?php Util::showError("register-pass1"); ?></span>

            <input type="password" name="password-retype" placeholder="Repita a Senha">

            <div class="error-msg" id="error-auth">
                <p><?php Util::showError("register-pass2"); ?></p>
            </div>

            <input type="submit" name="register" value="Criar Conta">
        </form>

        <div class="options-link">
            <a id="link-A" href="#">Login</a>
            <a id="link-B" href="#">Esqueci a Senha</a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>
<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>