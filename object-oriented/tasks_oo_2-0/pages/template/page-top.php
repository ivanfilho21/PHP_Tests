<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Task Manager 2.0</title>
    <link rel="stylesheet" href="<?php echo $relPath; ?>assets/css/reset.css">
    <?php foreach ($stylesheets as $css): ?>
    <link rel="stylesheet" href="<?php echo $relPath; ?>assets/css/<?php echo $css; ?>.css">
    <?php endforeach ?>
    <?php foreach ($scripts as $js): ?>
    <script src="<?php echo $relPath; ?>assets/js/<?php echo $js; ?>.js"></script>
    <?php endforeach ?>
</head>
<body>