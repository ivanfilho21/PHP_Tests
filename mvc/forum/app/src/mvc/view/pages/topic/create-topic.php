<section class="container-narrow">
    <h1>Novo Tópico</h1>

    <form id="form" method="post" data-validation-url="<?= URL ?>scripts/topic.php">

        <?php if (! empty($_SESSION["error-msg"])): ?>
        <div class="alert alert-danger">
            <span class="b">Foram encontrados os seguintes erros:</span>
            <ul class="ul ul-circle">
            <?php foreach($_SESSION["error-msg"] as $err): ?>
                <?php if (! empty($err)): ?>
                <li><?= $err ?></li>
                <?php endif ?>
            <?php endforeach ?>
            </ul>
        </div>
        <?php unset($_SESSION["error-msg"]) ?>
        <?php endif ?>

        <label>Board:</label>
        <div class="input-wrapper">
            <select name="board">
                <option value="0">-- Selecione uma Board --</option>
            <?php foreach ($boards as $cat => $boardArray): ?>
                <option disabled><?= $cat ?></option>
            <?php foreach ($boardArray as $board): ?>
                <option value="<?php echo $board->getId() ?>" <?php echo ($boardId == $board->getId()) ? "selected" : "" ?>><?php echo "&nbsp; &nbsp; &nbsp;" .$board->getName() ?></option>
            <?php endforeach ?>
            <?php endforeach ?>
            </select>
        </div>

        <label>Assunto:</label>
        <div class="input-wrapper">
            <input type="text" name="topic-title">
        </div>

        <label>Conteúdo:</label>
        <textarea id="txtarea" name="topic-content" rows="25"></textarea>

        <input class="btn btn-default" type="submit" name="submit" value="Publicar">
    </form>
</section>
<script>
    tinymce.init({
        selector: "#txtarea",
        language: "pt_BR",
        toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
    });
</script>