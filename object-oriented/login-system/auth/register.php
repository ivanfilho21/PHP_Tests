<?php session_start(); ?>
<?php $relPath = "../"; ?>
<?php $pageTitle = "Registre-se"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>

<!-- Main -->
<main class="main">
    <section class="login-holder">
        <h1>
            <?php echo ($registerFinished) ? $lang->get("account-created") : $lang->get("register-a"); ?>
        </h1>

        <span>
            <?php echo ($registerFinished) ? $lang->get("email-sent") : ""; ?>
        </span>

        <?php if (! $registerFinished) : ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <input type="email" required name="email" placeholder="<?php $lang->get('email'); ?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" autofocus>

                <span class="error-msg"><?php Util::showError("register-email"); ?></span>

                <input type="text" required name="username" placeholder="<?php $lang->get('name'); ?>" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">

                <span class="error-msg"><?php Util::showError("register-username"); ?></span>

                <input type="password" name="password" placeholder="<?php $lang->get('password'); ?>">

                <span class="error-msg"><?php Util::showError("register-pass1"); ?></span>

                <input type="password" name="password-retype" placeholder="<?php $lang->get('re-pass'); ?>">

                <div class="error-msg" id="error-auth">
                    <p><?php Util::showError("register-pass2"); ?></p>
                </div>

                <input type="submit" name="register" value="<?php $lang->get('register-a'); ?>">
            </form>
        <?php endif; ?>

        <div class="options-link">
            <a id="link-A" href="login.php"><?php $lang->get('login'); ?></a>
            <a id="link-B" href="password-recovery.php"><?php $lang->get('forgot-password-q'); ?></a>
            <div class="clear-fix"></div>
        </div>
        
    </section>
</main>
<!-- End of Main -->

<?php require "../template/page-bottom.php"; ?>