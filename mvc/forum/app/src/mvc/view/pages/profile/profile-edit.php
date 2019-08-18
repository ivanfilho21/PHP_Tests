
<form method="post">
    <label>Foto</label>
    <br>

    <label>Nome de Usuário:</label>
    <input type="text" name="username" maxlength="12" disabled value="<?= (false) ? "" : "" ?>">

    <label>Senha:</label>
        <input type="password" name="password" disabled value="<?= (false) ? "" : "&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" ?>">

    <label>Descreva você em poucas palavras:</label>
    <textarea name="description" rows="2" maxlength="100"><?= (false) ? "" : "" ?></textarea>

    <label>Sua Assinatura:</label>
    <textarea id="signature" name="signature" rows="4"><?= (false) ? "" : "" ?></textarea>
</form>

<script>
    tinymce.init({
        selector: "#signature",
        language: "pt_BR",
        toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
    });
</script>