<?php
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/dev/php-tests/object-oriented/login-system");
require ROOT_PATH . "/dependencies.php";
?>
<!doctype html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <?php require ROOT_PATH . "/template/parts/head-content.php"; ?>
    <?php if (isset($additionalStyles)) : ?>
	    <?php foreach ($additionalStyles as $style) : ?>
	    	<link rel="stylesheet" href="<?php echo $style; ?>.css">
	    <?php endforeach; ?>
	<?php endif; ?>
</head>
<body>
	<?php if (! empty($_GET["lang"])) : ?>
	    <?php $_SESSION["lang"] = $_GET["lang"]; ?>
	<?php endif; ?>
	
	<?php require ROOT_PATH . "/class/Language.php"; ?>
	<?php $lang = new Language(); ?>
	<?php #echo "Set language: " .$lang->getLanguage(); ?>

	<?php include ROOT_PATH . "/auth/scripts/logout.php"; ?>
	<?php include ROOT_PATH . "/template/parts/header.php"; ?>