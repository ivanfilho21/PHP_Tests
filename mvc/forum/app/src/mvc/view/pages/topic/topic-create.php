<section class="container-narrow">
    <h1>Novo Tópico</h1>

    <h4>Operação <?= (empty($post)) ? "insert" : "edit" ?></h4>

    <form id="form" method="post" data-validation-url="<?= URL ?>scripts/topic.php">
        <?php showErrorMessages() ?>

        <input type="hidden" name="operation" value="<?= (empty($post)) ? "insert" : "edit" ?>">

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
                <?php $mode = (! empty($_POST["mode"])) ? $_POST["mode"] : (! empty($topic) ? $topic->getMode() : "") ?>
                <select name="mode">
                    <option value="<?= \topic::MODE_OPEN_TOPIC ?>" <?= ($mode == \topic::MODE_OPEN_TOPIC) ? "selected" : "" ?>>Aberto</option>
                    <option value="<?= \topic::MODE_LOCKED_TOPIC ?>" <?= ($mode == \topic::MODE_LOCKED_TOPIC) ? "selected" : "" ?>>Trancado</option>
                </select>
            </div>

            <?php if ($this->user->getType() != \User::TYPE_NORMAL_USER): ?>
            <div>
                <label>Tipo:</label>
                <?php $type = (! empty($_POST["type"])) ? $_POST["type"] : (! empty($topic) ? $topic->getType() : "") ?>
                <select name="type">
                    <option value="<?= \topic::TYPE_NORMAL_TOPIC ?>" <?= ($type == \topic::TYPE_NORMAL_TOPIC) ? "selected" : "" ?>>Normal</option>
                    <option value="<?= \topic::TYPE_FIXED_TOPIC ?>" <?= ($type == \topic::TYPE_FIXED_TOPIC) ? "selected" : "" ?>>Fixo</option>
                </select>
            </div>
            <?php else: ?>
            <input type="hidden" name="type" value="<?= (! empty($_POST["type"])) ? $_POST["type"] : ((! empty($topic)) ? $topic->getType() : \topic::TYPE_NORMAL_TOPIC) ?>">
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