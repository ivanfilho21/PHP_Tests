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

    .reply-topic form label,
    .reply-topic form label > * {
        font-size: 1.25rem;
        text-align: center;
    }

    .like-button {
        /*font-size: 1.15rem;*/
    }
    .like-button i {
        color: royalblue;
    }
    .like-button .likes {
        /*font-size: 0.9rem;*/
        margin-left: 0.5rem;
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
                <?php if (! empty($this->user)): ?>
                    <div class="flex flex-childs-ml">
                    <?php if ($this->user->getId() == $post->getAuthorId()): ?>
                        <a href="<?= URL ?>topic/edit/<?= $topic->getUrl() ?>/<?= $post->getId() ?>" class="btn edit-button">Editar</a>
                    <?php endif ?>
                        <button title="Gostei" class="btn like-button" onclick="likePost.call(this)" data-topic="<?= $topic->getId() ?>" data-post="<?= $post->getId() ?>"><i class="fa fa-thumbs-up"></i></button>
                    </div>
                <?php endif ?>
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

<script>
    function updateLikes(topic) {
        let callback = function(res) {
            let likes = JSON.parse(res);
            let btn = document.getElementsByClassName("btn like-button");
            for (let i = 0; i < btn.length; i++) {
                let button = btn[i].getAttribute("data-post") ? btn[i] : "";
                if (button == "" || i >= Object.keys(likes).length) continue;
                // console.log(likes[i]);

                let likeCount = button.getElementsByClassName("likes")[0];
                likeCount = (likeCount) ? likeCount : document.createElement("span");
                likeCount.setAttribute("class", "likes");
                likeCount.innerHTML = likes[i];

                button.appendChild(likeCount);
            }
        };
        ajax("<?= URL ?>scripts/ajax-get-likes.php?topic=" + topic, callback);
    }

    function likePost() {
        if (! this) return;

        let callback = function(res) {
            updateLikes(topic);
        };
        let topic = this.getAttribute("data-topic");
        let post = this.getAttribute("data-post");
        let form = document.createElement("form");

        let i = document.createElement("input");
        i.type = "text";
        i.name = "post";
        i.value = post;

        form.appendChild(i);
        form.method = "post";
        ajax("<?= URL ?>scripts/ajax-like-post.php", callback, form);
    }

    window.onload = function() {
        let topic = "<?= $topic->getId() ?>";
        updateLikes(topic);
    }
</script>