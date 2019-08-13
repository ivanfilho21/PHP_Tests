<!-- <script src="https://cdn.tiny.cloud/1/5rvi4e9sj64xykloqo2untzya5o4m38tmzpl8r21jou4m7ae/tinymce/5/tinymce.min.js"></script> -->
<script src="<?php echo URL; ?>assets/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "#txtarea",
        language: "pt_BR",
        toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
    });
</script>

<section>
    <h1>Novo Tópico</h1>

    <form>
        <label>Board:</label>
        <select name="board">
            <option value="0">-- Selecione uma Board --</option>
        <?php foreach ($boards as $board): ?>
            <option value="<?php echo $board->getId(); ?>" <?php echo ($boardId == $board->getId()) ? "selected" : ""; ?>><?php echo $board->getName(); ?></option>
        <?php endforeach; ?>
        </select>

        <label>Assunto:</label>
        <div class="input-wrapper">
            <input type="text" name="topic-title">
        </div>

        <label>Conteúdo:</label>
        <textarea id="txtarea" name="topic-content" rows="25"></textarea>

        <input type="submit" name="submit" value="Publicar">
    </form>
</section>