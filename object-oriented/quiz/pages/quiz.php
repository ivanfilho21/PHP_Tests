<?php $relPath = "../" ?>
<?php $title = "My Quizes" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/quiz.php" ?>

<h1><?= $quiz->getTitle() ?></h1>

<br>
<?php foreach ($questions as $question): ?>
<div><?= $question->getTitle() ?></div>

<?php foreach ($question->getAnswers() as $answer): ?>
<div><?= $answer->getContent() ?></div>
<?php endforeach ?>
<br>

<?php endforeach ?>

<?php require $relPath ."pages/template/page-bottom.php" ?>