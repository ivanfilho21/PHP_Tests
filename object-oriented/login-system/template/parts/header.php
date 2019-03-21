<header class="header header-bg">
    <div class="header-container">
        <!-- Logo -->
        <a class="logo"href="<?php echo $relPath; echo ($user != null) ? 'dashboard.php' : 'index.php'?>">Login System</a>

        <!-- navigation bar -->
        <nav class="top-navigation">
            <ul>
                <?php if ($user != null) : ?>
                    <li><a href="?logout">Sair</a></li>
                <?php else : ?>
                    <li><a href="<?php echo $relPath; ?>auth/login.php">Login</a></li>
                    <li><a href="<?php echo $relPath; ?>auth/register.php">Registre-se</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="clear-fix"></div>
    </div>
</header>