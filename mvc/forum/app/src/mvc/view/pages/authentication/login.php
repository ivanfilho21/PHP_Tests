<section class="form-wrapper">
    <div class="container">
        <h1>Login</h1>

        <form method="post">
            <label class="rf">Nome de Usuário</label>
            <div class="input-wrapper">
                <input type="text" name="username" maxlength="12" autofocus="on" value="<?= (isset($_POST["username"])) ? $_POST["username"] : "" ?>">
            </div>

            <label class="rf">Senha</label>
            <div class="input-wrapper">
                <input type="password" name="password" maxlength="255" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>">
            </div>

            <label class="cb-wrapper">
                <input id="user-terms" type="checkbox" name="session">
                <span class="checkmark"></span>
                <span class="label">Continuar logado</span>
            </label>

            <?php if (! empty($_SESSION["error-login"])): ?>
            <?php unset($_SESSION["error-login"]) ?>
            <div class="alert alert-danger">Usuário ou Senha incorretos.</div>
            <?php endif ?>

            <input type="submit" name="submit" value="Entrar">

            <div class="account-options">
                <a href="#">Recuperar Conta</a>
                <a href="#">Criar uma Conta</a>
            </div>
        </form>
    </div>
</section>