<?php session_start(); ?>
<?php $relPath = ""; ?>
<?php $pageTitle = "Dashboard"; ?>
<?php $pageDescription = "Restricted area accessible only by logged in users."; ?>
<?php $additionalStyles = array(); ?>
<?php $additionalStyles[] = "dashboard"; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<section class="main-content">
	<h1>Login System - Dashboard</h1>

	<p>
		<?php $lang->get("welcome"); ?>,
		<?php echo ($user != null) ? $user->getUsername() . "." : ""; ?>
	</p>
</section>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>