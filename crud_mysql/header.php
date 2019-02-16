<?php if (! $userIsLogged) : ?>
	<header>
		<div class="app-name">
			<a href="index.php" id="site-name">CRUD MySQL</a>
		</div>
		
		<nav>
			<ul>
				<?php if ($userIsLogged) : ?>
					<li><a href="?sign_out">Sign Out</a></li>
				<?php else : ?>
					<li><a href="login.php">Sign In</a></li>
					<li><a href="registration.php">Sign Up</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>
	<div class="clear-fix"></div>
<?php else : ?>
	<header style="padding-top: 18px;">
		<div class="app-name">
			<a href="index.php"><img src="icon/database-cl.svg" width="32px"></a>
			<a href="index.php" style="padding: 0 0 0 .5em;">Crud MySQL</a>
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
