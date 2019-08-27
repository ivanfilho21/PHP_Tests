<?php $relPath = "../" ?>
<?php $title = "My Quizes" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/quiz.php" ?>

<div class="card">
    <div class="card-header">
        <h1><?= utf8_encode($quiz->getTitle()) ?></h1>
    </div>

    <div class="card-body">
        <?php $i = 0 ?>
        <?php foreach ($questions as $question): ?>
        <?php $i++ ?>
        <div><?= $i ?>) <?= $question->getTitle() ?></div>

        <?php foreach ($question->getAnswers() as $answer): ?>
        <label style="font-size: 1rem; color: black;"><input type="radio" name="answer[<?= $i ?>]"> <?= $answer->getContent() ?></label>
        <br>
        <?php endforeach ?>
        <br>

        <?php endforeach ?>
    </div>
</div>

<?php require $relPath ."pages/template/page-bottom.php" ?>