<style>
    .topic {
        border: 1px solid transparent;
        border-radius: 6px;
        background-color: #d6e0ea;
    }
    .topic .title {
        font-size: 1.25rem;
        padding: 0.5rem 1rem;
        background-color: #333;
        color: ghostwhite;
    }
    .topic .posts {
        margin: 1.5rem 0.5rem 1rem 0.5rem;

    }
    .post {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 0.1rem;
        background-color: white;
    }

    .post .author-info {
        flex: 1;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .post .body {
        flex: 4;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .post .date {
        font-size: 0.8rem;
        color: gray;
    }

    .post .author {
        margin-bottom: 0.75rem;
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        text-align: center;
        border: 2px dotted #ccc;
    }

    .reply-topic form {
        margin-top: 1rem;
    }

    .reply-topic form label {
        font-size: 1.25rem;
        text-align: center;
    }
</style>

<section class="topic">
    <div class="title"><?= $topic->getTitle() ?></div>

    <?php foreach ($posts as $post): ?>
        <article class="post">
            <div class="author-info">
                <div>Foto</div>
                <div class="author"><a href="<?= URL ?>users/<?= $post->getAuthor()->getUsername() ?>"><?= $post->getAuthor()->getUsername() ?></a></div>
                <div>Descrição de Usuário</div>
                <div>
                    Status de Usuário<br>TODO <br>Membro desde <br>Mensagens <br>etc
                    <div>Membro desde <?= $this->date->translateToDate($post->getAuthor()->getCreationDate()) ?></div>
                </div>
            </div>

            <div class="body">
                <div class="flex justify-content-spc-btw">
                    <div class="date"><?= $this->date->translateTime($post->getCreationDate(), 1) ?> às <?= $this->date->translateToTime($post->getCreationDate()) ?></div>
                    <!-- <button class="btn">Responder</button> -->
                </div>

                

                <div class="content"><?= $post->getContent() ?></div>
            </div>
        </article>
    <?php endforeach ?>

    <?php $this->requireView("parts/pagination", array("page" => $page, "pages" => $pages, "baseUrl" => $baseUrl), true) ?>

    <?php if (! empty($this->user)): ?>
        <div class="reply-topic">
            <form class="container" method="post">
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
                
                <label>Escreva sua resposta para o Tópico <span class="i">"<?= $topic->getTitle() ?>"</span>:</label>
                <textarea id="txtarea" name="post-content" rows="15"><?= (! empty($_POST["post-content"])) ? $_POST["post-content"] : "" ?></textarea>

                <input class="btn btn-default" type="submit" name="submit" value="Responder">
            </form>
            <script>
                tinymce.init({
                    selector: "#txtarea",
                    language: "pt_BR",
                    toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
                });
            </script>
        </div>
    <?php endif ?>
</section>