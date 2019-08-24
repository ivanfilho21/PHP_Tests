<?php $relPath = "../" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/quiz.php" ?>

<h1><?= $quiz->getTitle() ?></h1>

<?php require $relPath ."pages/template/page-bottom.php" ?>