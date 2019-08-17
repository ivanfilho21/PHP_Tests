<style>
    .topic {
        padding: 0.5rem;
        background-color: #d6e0ea;
    }
    .topic-title {
        background-color: #111;
        color: ghostwhite;
    }
    .topic-title .title {
        font-size: 1.25rem;
    }
    .post {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 0.25rem;
        background-color: white;
    }

    .post .author-info {}

    .post .body {
        flex: 4;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        overflow: hidden;
    }

    .post .date {
        font-size: 0.8rem;
        color: gray;
    }

    .reply-topic {
        background-color: #d6e0ea;
    }

    .reply-topic form {
        margin-top: 1.5rem;
        padding: 0;
    }

    .reply-topic form label {
        margin-bottom: 1rem;
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

<div class="topic-title"><div class="container-wider title"><?= (($topic->getType() == \Topic::TYPE_FIXED_TOPIC) ? " [Fixo] " : "") .$topic->getTitle() .(($topic->getMode() == \Topic::MODE_LOCKED_TOPIC) ? " (Trancado)" : "") ?></div></div>

<?php $this->requireView("parts/pagination", array("page" => $page, "pages" => $pages, "baseUrl" => $baseUrl), true) ?>

<section class="topic">

    <?php foreach ($posts as $post): ?>
        <?php $userData = array("user" => $post->getAuthor()) ?>
        <article class="post">
            <?php $this->requireView("parts/user/user-info", $userData, true) ?>

            <div class="body">
                <div class="flex justify-content-spc-btw">
                    <div class="date">
                        <?php if ($post->getCreationDate() == $post->getUpdateDate()): ?>
                        <?= $this->date->translateTime($post->getCreationDate(), 1) ?> às <?= $this->date->translateToTime($post->getCreationDate()) ?>  
                        <?php else: ?>
                        Atualizado <?= $this->date->translateTime($post->getUpdateDate(), 1) ?> às <?= $this->date->translateToTime($post->getUpdateDate()) ?>
                        <?php endif ?>
                    </div>
                <?php if (! empty($this->user)): ?>
                    <div class="flex flex-children-ml">
                    <?php $cond = ($topic->getPost()->getId() == $post->getId() && $this->user->getId() == $topic->getAuthorId() && $this->user->getId() == $post->getAuthorId()) ?>
                    <?php if ($this->user->getId() == $post->getAuthorId()): ?>
                        <a href="<?= URL .(($cond) ? "topic/edit/" : "topics/") .$topic->getUrl() .(($cond) ? "" : "/" .$page ."/" .$post->getId()) ?>" class="btn <?= ($cond) ? "btn-default" : "" ?> edit-button">Editar<?= ($cond) ? " Tópico" : "" ?></a>
                    <?php endif ?>
                        <button title="Gostei" class="btn like-button" onclick="likePost.call(this)" data-topic="<?= $topic->getId() ?>" data-post="<?= $post->getId() ?>"><i class="fa fa-thumbs-up"></i></button>
                    </div>
                <?php endif ?>
                </div>

                <div class="content"><?= $post->getContent() ?></div>
                <?php $this->requireView("parts/user/signature", $userData, true) ?>
            </div>
        </article>
    <?php endforeach ?>

    <?php if (! empty($this->user) && $topic->getMode() != \Topic::MODE_LOCKED_TOPIC): ?>
        <div id="reply-topic" class="reply-topic">
            <form class="containerx" method="post">
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

                <input type="hidden" name="post-id" value="<?= (! empty($editPost)) ? $editPost->getId() : "" ?>">
                
                <!-- <label>Escreva sua resposta para o Tópico <span class="i">"<?= $topic->getTitle() ?>"</span>:</label> -->
                <textarea id="txtarea" name="post-content" rows="15"><?= (! empty($_POST["post-content"])) ? $_POST["post-content"] : (! empty($editPost) ? $editPost->getContent() : "") ?></textarea>

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

<?php $this->requireView("parts/pagination", array("page" => $page, "pages" => $pages, "baseUrl" => $baseUrl), true) ?>

<script>
    function updateLikes(topic) {
        let limit = "<?= $limitPerPage ?>";
        let page = "<?= $page ?>";
        let callback = function(res) {
            let likes = JSON.parse(res);
            // console.log(likes);

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
        ajax("<?= URL ?>scripts/ajax-get-likes.php?limit=" + limit + "&page=" + page + "&topic=" + topic, callback);
    }

    function likePost() {
        if (! this) return;

        let callback = function(res) {
            if (res != "true") alert(res);
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
        // If edit post mode is on, scroll to form
        let editMode = "<?= (! empty($editPost)) ? "true" : "false" ?>";
        // console.log(editMode);
        if (editMode == "true") {
            // Scroll
            // console.log("scroll");
            document.getElementById("reply-topic").scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});
        }
        
        let topic = "<?= $topic->getId() ?>";
        updateLikes(topic);
    }
</script>