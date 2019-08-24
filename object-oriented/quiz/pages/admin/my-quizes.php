<?php $relPath = "../../" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php $quizes = $dba->getTable("quizes")->getAll() ?>

<h1>My Quizes</h1>

<?php foreach ($quizes as $quiz): ?>
<?php $questions = $dba->getTable("questions")->getAll(array("quiz_id" => $quiz->getId())) ?>
<div>
    <div>
        <a href="<?= $relPath ?>pages/quiz.php?id=<?= $quiz->getId() ?>"><?= $quiz->getTitle() ?></a>
    </div>
    <br>
    <?php foreach ($questions as $question): ?>
    <?php $options = $dba->getTable("answers")->getAll(array("question_id" => $question->getId())) ?>
    <div><?= $question->getTitle() ?></div>
    <div><?= count($options) ?> options</div>
    <br>
    <?php endforeach ?>
</div>
<?php endforeach ?>
<?php require $relPath ."pages/template/page-bottom.php" ?>