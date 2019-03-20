<?php $relPath = ""; ?>
<?php $pageTitle = "Dashboard"; ?>
<?php $pageDescription = ""; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<section class="main-content">
	<h1>Login System - Dashboard</h1>

	<p>
		<?php echo ($user != null) ? "Welcome, " . $user->getUsername() . "." : ""; ?>
	</p>
</section>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>