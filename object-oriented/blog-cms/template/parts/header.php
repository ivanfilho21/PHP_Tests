<header class="header">
    <div class="header-container">
        <!-- Logo -->
        <a class="logo"href="<?php echo $relPath; ?>index.php";">Blog CMS</a>

        <!-- navigation bar -->
        <nav class="top-navigation">
            <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <?php if ($user != null) : ?>
                    <li><a href="?logout">Sign Out</a></li>
                <?php else : ?>
                    <li><a href="<?php echo $relPath; ?>auth/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="clear-fix"></div>
    </div>
</header>