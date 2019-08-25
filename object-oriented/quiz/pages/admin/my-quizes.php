<?php $relPath = "../../" ?>
<?php $title = "My Quizes" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/my-quizes.php" ?>

<h1>My Quizes</h1>

<div class="row">
<?php foreach ($quizes as $quiz): ?>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <a href="<?= $relPath ?>pages/quiz.php?id=<?= $quiz->getId() ?>"><?= $quiz->getTitle() ?></a>
            </div>

            <div class="card-body">
                <?= count($quiz->getQuestions()) ?> question<?= count($quiz->getQuestions()) == 1 ? "" : "s" ?>
            </div>
        </div>
    </div>

<?php endforeach ?>
</div>


<?php require $relPath ."pages/template/page-bottom.php" ?>