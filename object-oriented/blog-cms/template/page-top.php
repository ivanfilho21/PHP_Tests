<?php
    # Root Path Constant
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/dev/php-tests/object-oriented/blog-cms");
?>
<?php require ROOT_PATH . "/main.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog CMS - <?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <?php require ROOT_PATH . "/template/parts/head-content.php"; ?>
    <?php foreach ($additionalStyles as $style) : ?>
    	<link rel="stylesheet" href="<?php echo $style; ?>.css">
    <?php endforeach; ?>
</head>
<body>
<?php include ROOT_PATH . "/template/parts/header.php"; ?>