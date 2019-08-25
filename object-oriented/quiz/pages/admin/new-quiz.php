<?php $relPath = "../../" ?>
<?php $title = "New Quiz" ?>
<?php require $relPath ."pages/template/page-top.php" ?>
<?php require $relPath ."scripts/new-quiz-submit.php" ?>

<?php $letters = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z") ?>

<h1>Novo Quiz</h1>

<form method="post">
    
    <div class="form-group">
        <label>Nome do Quiz:</label>
        <input type="text" name="quiz-title" value="<?= isset($title) ? $title : "" ?>" class="form-control">
    </div>

    
    <br>

    <div class="card">
        <div class="card-header">
            <h5>Questões</h5>

            <button type="submit" name="add-question" class="btn btn-success"><span class="nc-icon nc-simple-add"></span> Questão</button>
        </div>

        <div class="card-body">
        <?php foreach ($questions as $i => $vq): ?>
            <div class="form-group">                    
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="h5"><?= ($i + 1) ?>) Questão:</div>

                    <?php if ($i != 0): ?>
                    <button type="submit" name="remove-question" value="<?= $i ?>" class="btn btn-danger" style="margin-top: -15px"><span class="nc-icon nc-simple-remove"></span> Questão</button>
                    <?php endif ?>
                </div>
                <input type="text" name="title[<?= $i ?>]" value="<?= isset($questions[$i]) ? $questions[$i] : "" ?>" class="form-control">
            </div>

            <!-- <button type="submit" name="add-answer" value="<?= $i ?>" class="btn btn-success btn-round"><span class="nc-icon nc-simple-add"></span> answer</button>
            <br> -->

            <?php foreach ($options[$i] as $j => $va): ?>
                <br>
                
                <div style="display: flex;">
                    <label class="mr-2" style="text-align: right;"><?= $letters[$j] .")" ?></label>
                    
                    <input type="text" name="answer[<?= $i ?>][<?= $j ?>]" value="<?= isset($options[$i][$j]) ? $options[$i][$j] : "" ?>" class="form-control">
                    
                    <label class="ml-2" style="white-space: nowrap;">
                        <input type="radio" name="correct[<?= $i ?>]" value="<?= $j ?>" <?= (isset($corrects[$i]) && $corrects[$i] == $j) ? "checked" : (($j == 0) ? "checked" : "") ?>>
                        Certa
                    </label>

                    <!-- <?php if ($j != 0): ?>
                    <button type="submit" name="remove-answer" value="<?= $i ."," .$j ?>" class="col-2 btn btn-danger btn-round">Remove</button>
                    <?php endif ?> -->
                </div>
            <?php endforeach ?>
            <br>
            <br>
        <?php endforeach ?>
        </div>

        <div class="row">
            <div class="ml-auto mr-auto">
                <button type="submit" name="submit" class="btn btn-success btn-round">Save Quiz</button>
            </div>
        </div>
        <br>
    </div>
</form>

<?php require $relPath ."pages/template/page-bottom.php" ?>