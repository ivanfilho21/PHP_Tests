<?php
    # Root Path Constant
    define("ROOT_PATH", "" . $_SERVER["DOCUMENT_ROOT"] . "/dev/php-tests/object-oriented/blog-cms");
?>
<?php require ROOT_PATH . "/main.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog CMS - <?php echo $pageTitle; ?></title>
    <meta name="description" content="Blog CMS allows users to easily create and manage their own blog;">
    <?php require ROOT_PATH . "/template/parts/head-content.php"; ?>
</head>
<body>
<?php include ROOT_PATH . "/template/parts/header.php"; ?>