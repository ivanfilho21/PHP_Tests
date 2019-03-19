<?php
    # Root Path Constant
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/dev/php-tests/object-oriented/blog-cms");
?>
<?php require ROOT_PATH . "/dependencies.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?> - Blog CMS</title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <?php require ROOT_PATH . "/template/parts/head-content.php"; ?>
    <?php if (isset($additionalStyles)) : ?>
	    <?php foreach ($additionalStyles as $style) : ?>
	    	<link rel="stylesheet" href="<?php echo $style; ?>.css">
	    <?php endforeach; ?>
	<?php endif; ?>
</head>
<body>
	<?php include ROOT_PATH . "/auth/scripts/logout.php"; ?>
	<?php include ROOT_PATH . "/template/parts/header.php"; ?>