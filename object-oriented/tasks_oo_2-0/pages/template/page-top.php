<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Task Manager 2.0</title>
    <link rel="stylesheet" href="<?php echo $relPath; ?>assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo $relPath; ?>assets/css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php foreach ($stylesheets as $css): ?>
    <link rel="stylesheet" href="<?php echo $relPath; ?>assets/css/<?php echo $css; ?>.css">
    <?php endforeach ?>
    <?php foreach ($scripts as $js): ?>
    <script src="<?php echo $relPath; ?>assets/js/<?php echo $js; ?>.js"></script>
    <?php endforeach ?>
</head>
<body>
	<header>
		<a class="logo" href="<?php echo $relPath; ?>index.php">Task Manager</a>
	</header>
    <section class="mcontainer">