<?php require "../config.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script defer src="../bootstrap/js/jquery.min.js"></script>
    <script defer src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        pre {
            color: white;
        }
    </style>
</head>
<body class="bg-dark text-light">
        <style>
            .navbar a {
                color: white;
            }
            .navbar-brand {
                font-weight: bold;
            }
        </style>
        <nav class="navbar navbar-default bg-secondary text-light">
            <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="#">MegaSena CRUD</a></div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Novo Sorteio</a></li>
            </ul>
            </div>
        </nav>
    <section class="container">