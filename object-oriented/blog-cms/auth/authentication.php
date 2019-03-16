<!-- Must declare this for files that are not in root folder -->
<?php $relPath = "../"; ?>
<?php $pageTitle = "Login"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication-script.php"; ?>

<!-- Main Content -->
<main class="main-content">
    <section class="login-holder">
        <h1>
        <?php if ($registerMode) : ?>
            Registrar-se
        <?php else : ?>
            Login
        <?php endif; ?>
        </h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username" placeholder="Nome de Usuário" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">
            <input type="password" name="password" placeholder="Senha">

            <?php if ($registerMode) : ?>
                <input type="password" name="retype-password" placeholder="Repita a Senha">
            <?php endif; ?>

            <span class="error-msg"><?php Util::showError("login"); ?></span>
            <span class="error-msg"><?php Util::showError("register"); ?></span>

            <input type="submit" name="<?php echo ($registerMode) ? 'register' : 'login'; ?>" value="<?php echo ($registerMode) ? 'Criar Conta' : 'Entrar'; ?>">
        </form>

        <div class="options-link">
            <?php if ($registerMode) : ?>
                <a id="link-A" href="authentication.php">Fazer Login</a>
            <?php else : ?>
                <a id="link-A" href="?register">Criar Conta</a>
            <?php endif; ?>
            
            <a id="link-B" href="#">Esqueci a Senha</a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>
<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>