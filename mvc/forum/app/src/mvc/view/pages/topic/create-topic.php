<section>
    <h1>Novo Tópico</h1>

    <form id="form" method="post" data-validation-url="<?= URL ?>scripts/topic.php">

        <div style="display: flex;">
            <div>
                <label>Categoria:</label>
                <select name="category">
                    <option value="0">-- Selecione uma Categoria --</option>
                <?php foreach ($boards as $board): ?>
                    <option value="<?php echo $board->getId(); ?>" <?php echo ($boardId == $board->getId()) ? "selected" : ""; ?>><?php echo $board->getName(); ?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-left: 0.75rem">
                <label>Board:</label>
                <select name="board">
                    <option value="0">-- Selecione uma Board --</option>
                <?php foreach ($boards as $board): ?>
                    <option value="<?php echo $board->getId(); ?>" <?php echo ($boardId == $board->getId()) ? "selected" : ""; ?>><?php echo $board->getName(); ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>

        <label>Assunto:</label>
        <div class="input-wrapper">
            <input type="text" name="topic-title">
        </div>

        <label>Conteúdo:</label>
        <textarea id="txtarea" name="topic-content" rows="25"></textarea>

        <input type="submit" name="submit" value="Publicar">
    </form>
</section>