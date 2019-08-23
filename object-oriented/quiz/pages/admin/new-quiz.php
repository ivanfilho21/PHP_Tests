<?php $relPath = "../../" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/new-quiz-submit.php" ?>

<h1>New Quiz</h1>

<form method="post">
    <button type="submit" name="add-question">Add Question</button>

    <?php foreach ($questions as $i => $vq): ?>
    <br><br>

    <label>Title</label>
    <input type="text" name="title[<?= $i ?>]" value="<?= isset($titles[$i]) ? $titles[$i] : "" ?>">
    <br>

    <label>Answers</label><br>
    <button type="submit" name="add-answer" value="<?= $i ?>">Add Answer</button>
    <?php foreach ($answers[$i] as $j => $va): ?>
        <br>
        <input type="text" name="answer[<?= $i ?>][<?= $j ?>]" value="<?= isset($options[$i][$j]) ? $options[$i][$j] : "" ?>">
        <label><input type="radio" name="right[<?= $i ?>]"> Right</label>

        <br><br>
        <?php if ($j != 0): ?>
        <button type="submit" name="remove-answer" value="<?= $i ."," .$j ?>">Remove Answer</button>
        <?php endif ?>
    <?php endforeach ?>

    <br><br>
    <?php if ($i != 0): ?>
    <button type="submit" name="remove-question" value="<?= $i ?>">Remove Question</button>
    <?php endif ?>
    
    <?php endforeach ?>
    <br>
    <br>
    <input type="submit" name="submit" value="Save">
</form>

<?php require $relPath ."pages/template/page-bottom.php" ?>