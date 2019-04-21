<?php session_start(); ?>
<?php $relPath = "../"; ?>
<?php $pageTitle = "Alterar Senha"; ?>
<?php $pageDescription = ""; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "auth"; ?>
<?php require "../template/page-top.php"; ?>
<?php require "scripts/authentication.php"; ?>
<?php require "scripts/recovery.php"; ?>

<main class="main">
    <section class="login-holder">
        <h1><?php $lang->get("pass-recovery"); ?></h1>

        <?php if ($recoverySent) : ?>
        	<p><?php $lang->get("email-sent"); ?></p>

            <div class="TEST_DIV_REMOVE_ME_AFTER_LOCAL_TEST">
                <h2 style="color: darkseagreen;">It's a Secret to Everybody</h2>
                <p style="color: seagreen;">
                    Link:<br>
                    <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                </p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" <?php echo ($recoverySent) ? "style='display: none;'" : ""; ?>>

        	<label style="text-transform: none;"><?php $lang->get("recovery-label"); ?></label>

            <input type="email" required name="email" placeholder="<?php $lang->get('email'); ?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" autofocus>

            <div class="error-msg" id="error-auth">
                <p><?php Util::showError("recovery-email"); ?></p>
            </div>

            <input type="submit" name="recovery" value="<?php $lang->get('pass-recovery'); ?>">
        </form>

        <div class="options-link">
            <a id="link-B" href="register.php"><?php $lang->get("register-a"); ?></a>
            <a id="link-A" href="login.php"><?php $lang->get("login"); ?></a>
            <div class="clear-fix"></div>
        </div>     
        
    </section>
</main>


<?php require "../template/page-bottom.php"; ?>