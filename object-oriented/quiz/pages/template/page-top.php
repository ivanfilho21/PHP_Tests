<?php require $relPath ."config.php" ?>
<?php

$pages = array();
$pages[] = array("title" => "Home", "url" => "index", "icon" => "shop");
$pages[] = array("title" => "My Quizes", "url" => "pages/admin/my-quizes", "icon" => "single-copy-04");
$pages[] = array("title" => "New Quiz", "url" => "pages/admin/new-quiz", "icon" => "simple-add");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $relPath ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= $relPath ?>assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?= $title ?></title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?= $relPath ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $relPath ?>assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= $relPath ?>assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="<?= $relPath ?>assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
          <!-- <div class="logo-image-big">
            <img src="<?= $relPath ?>assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav" style="overflow: hidden;">
        <?php foreach ($pages as $page): ?>
          <li<?= ($title == $page["title"]) ? " class='active'" : "" ?>>
            <a href="<?= $relPath .$page["url"] ?>.php">
              <i class="nc-icon nc-<?= $page["icon"] ?>"></i>
              <p><?= $page["title"] ?></p>
            </a>
          </li>
        <?php endforeach ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="<?= $relPath ?>index.php">Quizes</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
<div class="content">