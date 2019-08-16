<section class="container-narrow">
    <h1>Novo Tópico</h1>

    <form id="form" method="post" data-validation-url="<?= URL ?>scripts/topic.php">

        <input type="hidden" name="mode" value="<?= (empty($post)) ? "insert" : "edit" ?>">

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

        <div class="flex flex-children-ml">
            <div>
                <label>Board:</label>
                <div class="input-wrapper">
                    <select name="board">
                        <option value="0">-- Selecione uma Board --</option>
                    <?php foreach ($boards as $cat => $boardArray): ?>
                        <option disabled><?= $cat ?></option>
                    <?php foreach ($boardArray as $board): ?>
                        <option value="<?= $board->getId() ?>" <?= ($boardId == $board->getId()) ? "selected" : "" ?>><?= "&nbsp; &nbsp; &nbsp;" .$board->getName() ?></option>
                    <?php endforeach ?>
                    <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div>
                <label>Modo:</label>
                <select name="mode">
                    <option value="<?= \topic::MODE_OPEN_TOPIC ?>">Aberto</option>
                    <option value="<?= \topic::MODE_LOCKED_TOPIC ?>">Trancado</option>
                </select>
            </div>

            <?php if ($this->user->getType() != \User::TYPE_NORMAL_USER): ?>
            <div>
                <label>Tipo:</label>
                <select name="type">
                    <option value="<?= \topic::TYPE_NORMAL_TOPIC ?>">Normal</option>
                    <option value="<?= \topic::TYPE_FIXED_TOPIC ?>">Fixo</option>
                </select>
            </div>
            <?php else: ?>
            <input type="hidden" name="type" value="<?= \topic::TYPE_NORMAL_TOPIC ?>">
            <?php endif ?>
        </div>

        <label>Assunto:</label>
        <div class="input-wrapper">
            <input type="text" name="topic-title" autofocus="on" value="<?= (! empty($_POST["topic-title"])) ? $_POST["topic-title"] : ((! empty($topic)) ? $topic->getTitle() : "") ?>">
        </div>

        <label>Conteúdo:</label>
        <textarea id="txtarea" name="topic-content" rows="25"><?= (! empty($_POST["topic-content"])) ? $_POST["topic-content"] : ((! empty($post)) ? $post->getContent() : "") ?></textarea>

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