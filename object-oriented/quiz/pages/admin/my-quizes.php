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
</div>
<?php endforeach ?>
<?php require $relPath ."pages/template/page-bottom.php" ?>