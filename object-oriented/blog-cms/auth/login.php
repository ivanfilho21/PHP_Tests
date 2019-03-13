<!-- Must declare this for files that are not in root folder -->
<?php $relPath = "../"; ?>
<?php $pageTitle = "Login"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "authentication.php"; ?>

<!-- Main Content -->
<main class="main-content">
    <section class="login-holder">
        <h1>Login</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username" placeholder="Nome de Usuário">
            <input type="password" name="password" placeholder="Senha">
            <input type="submit" name="login" value="Entrar">
        </form>

        <div class="options-link">
            <a id="link-A" href="#">Criar Conta</a>
            <a id="link-B" href="#">Esqueci a Senha</a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>

<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>