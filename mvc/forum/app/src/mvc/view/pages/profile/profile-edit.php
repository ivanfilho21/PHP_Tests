<style>
    .basic-info {
        display: flex;
        flex-direction: column;
    }

    .profile-picture {
        display: flex;
        /*padding: 1rem 2rem;*/
        /*text-align: center;*/
        /*border: 1px solid #ccc;*/
    }
    
    .profile-picture .image {
        display: flex;
        align-items: center;
        min-width: 100px;
        min-height: 100px;
        width: 160px;
        padding: 0.25rem;
        background-color: white;
    }

    .profile-picture .image-url {
        flex: 1;
        margin-left: 1rem;
    }

    .name-pass {
        margin-top: 1rem;
    }

    @media(min-width: 1024px) {
        .basic-info {
            flex-direction: row;
        }

        .profile-picture {
            flex: 1;
            flex-direction: column;
            align-items: center;
        }
        .profile-picture .image-url { margin-left: 0; margin-top: 1rem; }

        .name-pass {
            flex: 3;
            margin-top: 0;
            margin-left: 1rem;
        }
    }
</style>

<section class="container-narrow">
    <form method="post" enctype="multipart\form-data">
        <?php showErrorMessages() ?>

        <fieldset style="margin-top: 1.5rem">
            <legend>Informações Básicas</legend>

            <section class="basic-info">

                <div class="profile-picture">
                    <div class="image">
                        <img src="<?= ASSETS ?>img/no-profile-picture.png" alt="Profile Picture">
                    </div>

                    <div class="image-url">
                        <label style="margin-top: 0">URL da Imagem:</label>
                        <textarea name="img-url" autofocus="on" rows="4"><?= (! empty($_POST["img-url"])) ? $_POST["img-url"] : (! empty($user) ? $user->getImage(): "") ?></textarea>
                    </div>
                </div>

                <div class="name-pass">
                    <label style="margin-top: 0">Nome de Usuário:</label>
                    <div class="input-wrapper" style="align-items: stretch;">
                        <input type="text" name="username" maxlength="12" value="<?= (! empty($_POST["username"])) ? $_POST["username"] : (! empty($user) ? $user->getUsername() : "") ?>" <?= (empty($_SESSION["prof-sub"]["un"])) ? "disabled" : "autofocus='on'" ?>>
                        <button style="padding: 0.25rem" type="submit" name="edit-username" title="<?= (empty($_SESSION["prof-sub"]["un"])) ? "Permitir Alteração" : "Bloquear Alteração" ?>"><i class="fa fa-pen"></i></button>
                    </div>

                    <label>E-mail:</label>
                    <input type="email" name="email" disabled value="<?= ! empty($user) ? $user->getEmail() : "" ?>" title="Não é possível alterar o E-mail">

                    <label>Senha:</label>
                    <div class="input-wrapper" style="align-items: stretch;">
                        <input type="password" name="password" <?= (empty($_SESSION["prof-sub"]["ps"])) ? "value='&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;' disabled" : "autofocus='on'" ?>>
                        <button style="padding: 0.25rem" type="submit" name="edit-password" title="<?= (empty($_SESSION["prof-sub"]["ps"])) ? "Permitir Alteração" : "Bloquear Alteração" ?>"><i class="fa fa-pen"></i></button>
                    </div>
                </div>
            </section>
        </fieldset>
        
        <fieldset style="margin-top: 1.5rem">
            <legend>Outras Informações</legend>
            
            <label style="margin-top: 0">Descreva-se em poucas palavras:</label>
            <textarea name="description" rows="2" maxlength="100"><?= (! empty($_POST["description"])) ? $_POST["description"] : (! empty($user) ? $user->getDescription() : "") ?></textarea>

            <label>Sua Assinatura:</label>
            <textarea id="signature" name="signature" rows="20"><?= (! empty($_POST["signature"])) ? $_POST["signature"] : (! empty($user) ? $user->getSignature() : "") ?></textarea>
        </fieldset>


        <input class="btn btn-default" type="submit" name="submit" value="Salvar">
    </form>

    <script>
        tinymce.init({
            selector: "#signature",
            language: "pt_BR",
            toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
        });
    </script>
</section>