<?php if (! $userIsLogged) : ?>
	<header>
		<div class="app-name">
			<a href="<?php echo $PATH; ?>index.php" id="site-name">CRUD MySQL</a>
		</div>
		
		<nav>
			<ul>
				<?php if ($userIsLogged) : ?>
					<li><a href="?sign_out">Sign Out</a></li>
				<?php else : ?>
					<li><a href="<?php echo $PATH; ?>auth/login.php">Sign In</a></li>
					<li><a href="<?php echo $PATH; ?>auth/registration.php">Sign Up</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>
	<div class="clear-fix"></div>
<?php else : ?>
	<header style="padding-top: 18px;">
		<div class="app-name">
			<a href="<?php echo $PATH; ?>index.php"><img src="<?php echo $PATH; ?>icon/database-cl.svg" width="32px"></a>
			<a href="<?php echo $PATH; ?>index.php" style="padding: 0 0 0 .5em;">CRUD MySQL</a>
		</div>

		<nav>
			<ul>
				<li><a href="profile.php"><?php echo $user["username"]; ?></a></li>
				<li><a href="?sign_out">Sign Out</a></li>
			</ul>
			
		</nav>
	</header>
	<div class="clear-fix" style="padding: 0; "></div>
<?php endif; ?>
