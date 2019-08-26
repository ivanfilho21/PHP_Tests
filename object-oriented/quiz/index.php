<?php $relPath = "" ?>
<?php $title = "Home" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/my-quizes.php" ?>

<style>
    .quiz-title {
        font-size: 1.25rem;
    }
</style>

<h1>Quizes</h1>

<div class="row">
<?php foreach ($quizes as $quiz): ?>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <a class="quiz-title" href="<?= $relPath ?>pages/quiz.php?id=<?= $quiz->getId() ?>"><?= $quiz->getTitle() ?></a>
            </div>

            <div class="card-body">
                <?= count($quiz->getQuestions()) ?> pergunta<?= count($quiz->getQuestions()) == 1 ? "" : "s" ?>
            </div>
        </div>
    </div>

<?php endforeach ?>
</div>


<?php require $relPath ."pages/template/page-bottom.php" ?>

<?php require $relPath ."pages/template/page-bottom.php" ?>