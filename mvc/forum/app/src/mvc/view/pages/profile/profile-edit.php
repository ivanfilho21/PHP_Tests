<form method="post" enctype="multipart\form-data">
    <?php showErrorMessages() ?>

    <label>Foto:</label>
    <label>URL da Imagem</label>
    <input type="url" name="img-url" value="" autofocus="on">

    <label>Nome de Usuário:</label>
    <div class="input-wrapper">
        <input type="text" name="username" maxlength="12" value="<?= (! empty($_POST["username"])) ? $_POST["username"] : (! empty($user) ? $user->getUsername() : "") ?>" <?= (empty($_SESSION["prof-sub"]["un"])) ? "disabled" : "autofocus='on'" ?>>
        <button type="submit" name="edit-username" title="<?= (empty($_SESSION["prof-sub"]["un"])) ? "Permitir Alteração" : "Bloquear Alteração" ?>">Alterar</button>
    </div>

    <label>Senha:</label>
    <div class="input-wrapper">
        <input type="password" name="password" <?= (empty($_SESSION["prof-sub"]["ps"])) ? "value='&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;' disabled" : "autofocus='on'" ?>>
        <button type="submit" name="edit-password" title="<?= (empty($_SESSION["prof-sub"]["ps"])) ? "Permitir Alteração" : "Bloquear Alteração" ?>">Alterar</button>
    </div>

    <label>Descreva-se em poucas palavras:</label>
    <textarea name="description" rows="2" maxlength="100"><?= (! empty($_POST["description"])) ? $_POST["description"] : (! empty($user) ? $user->getDescription() : "") ?></textarea>

    <label>Sua Assinatura:</label>
    <textarea id="signature" name="signature" rows="4"><?= (! empty($_POST["signature"])) ? $_POST["signature"] : (! empty($user) ? $user->getSignature() : "") ?></textarea>

    <input class="btn btn-default" type="submit" name="submit" value="Salvar">
</form>

<script>
    tinymce.init({
        selector: "#signature",
        language: "pt_BR",
        toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
    });
</script>