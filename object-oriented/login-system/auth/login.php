<?php session_start(); ?>
<?php $relPath = "../"; ?>
<?php $pageTitle = "Login"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>

<!-- Main -->
<main class="main">
    <section class="login-holder">
        <h1>Login</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="email" name="email" placeholder="<?php $lang->get("email"); ?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" autofocus>
            
            <input type="password" name="password" placeholder="<?php $lang->get("password"); ?>">

            <label>
                <input type="checkbox" name="keep-logged" <?php echo (isset($_POST["keep-logged"])) ? "checked" : ""; ?>><?php $lang->get("keep-me-connected"); ?><br>
            </label>

            <div class="error-msg" id="error-auth">
                <p><?php Util::showError("login"); ?></p>
            </div>
            
            <input type="submit" name="login" value="<?php $lang->get("login"); ?>">
        </form>

        <div class="options-link">
            <a id="link-A" href="register.php"><?php $lang->get("register"); ?></a>
            <a id="link-B" href="password-recovery.php"><?php $lang->get("forgot-password-q"); ?></a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>
<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>