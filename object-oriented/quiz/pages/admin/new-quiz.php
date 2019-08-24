<?php $relPath = "../../" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/new-quiz-submit.php" ?>

<?php $letters = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z") ?>

<h1>New Quiz</h1>

<form method="post">
    <label>Name:</label>
    <input type="text" name="quiz-title" value="<?= isset($title) ? $title : "" ?>">
    <br><br>

    <button type="submit" name="add-question">Add Question</button>

    <br><br>
    <fieldset>
        <legend>Questions</legend>
        <br>
        <?php foreach ($questions as $i => $vq): ?>
        <label>Question:</label>
        <input type="text" name="title[<?= $i ?>]" value="<?= isset($questions[$i]) ? $questions[$i] : "" ?>">
        <br><br>

        <button type="submit" name="add-answer" value="<?= $i ?>">Add Answer</button>
        <br><br>

        <fieldset>
            <legend>Answers</legend>
            
            <?php foreach ($options[$i] as $j => $va): ?>
                <br>
                <label><?= $letters[$j] .")" ?></label>
                <input type="text" name="answer[<?= $i ?>][<?= $j ?>]" value="<?= isset($options[$i][$j]) ? $options[$i][$j] : "" ?>">
                <label><input type="radio" name="correct[<?= $i ?>]" value="<?= $j ?>" <?= (isset($corrects[$i]) && $corrects[$i] == $j) ? "checked" : (($j == 0) ? "checked" : "") ?>> Correct</label>

                <br><br>
                <?php if ($j != 0): ?>
                <button type="submit" name="remove-answer" value="<?= $i ."," .$j ?>">Remove Answer</button>
                <?php endif ?>
            <?php endforeach ?>
        </fieldset>


        <br><br>
        <?php if ($i != 0): ?>
        <button type="submit" name="remove-question" value="<?= $i ?>">Remove Question</button>
        <?php endif ?>
        
        <?php endforeach ?>
    </fieldset>
    <br>
    <br>
    <input type="submit" name="submit" value="Save">
</form>

<?php require $relPath ."pages/template/page-bottom.php" ?>