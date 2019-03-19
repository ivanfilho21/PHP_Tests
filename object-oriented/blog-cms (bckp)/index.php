<?php $relPath = ""; ?>
<?php $pageTitle = "Home Page"; ?>
<?php $pageDescription = "Blog CMS allows users to easily create and manage their own blog."; ?>
<?php require "template/page-top.php"; ?>

<!-- Main Content -->
<h1>Simple Blog CMS - Home</h1>

<p>
	<?php echo ($user != null) ? "Welcome, " . $user->getUsername() . "." : ""; ?>
</p>
<!-- End of Main -->

<?php require "template/page-bottom.php"; ?>