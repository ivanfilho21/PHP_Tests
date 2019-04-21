<header class="header header-bg">
    <div class="header-container">
        <!-- Logo -->
        <a class="logo"href="<?php echo $relPath; echo ($user != null) ? 'dashboard.php' : 'index.php'?>">Login System</a>

        <!-- navigation bar -->
        <nav class="top-navigation">
            <ul>
                <?php if ($user != null) : ?>
                    <li><a href="?logout"><?php $lang->get("logout"); ?></a></li>
                <?php else : ?>
                    <li><a href="<?php echo $relPath; ?>auth/login.php"><?php $lang->get("login"); ?></a></li>
                    <li><a href="<?php echo $relPath; ?>auth/register.php"><?php $lang->get("register"); ?></a></li>
                <?php endif; ?>
                <li><a <?php echo ($lang->getLanguage() === "en") ? "class='active'" : ""; ?> href="?lang=en" title="<?php $lang->get('en'); ?>"><img src="<?php echo $relPath; ?>img/united-kingdom.svg"></a></li>
                <li><a <?php echo ($lang->getLanguage() === "pt-br") ? "class='active'" : ""; ?> href="?lang=pt-br" title="<?php $lang->get('pt-br'); ?>"><img src="<?php echo $relPath; ?>img/brazil.svg"></a></li>
            </ul>
        </nav>

        <div class="clear-fix"></div>
    </div>
</header>