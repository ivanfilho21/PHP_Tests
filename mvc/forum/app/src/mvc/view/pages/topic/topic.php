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
    }

    .post .body {
        flex: 4;
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
</style>

<section class="topic">
    <div class="title"><?= $topic->getTitle() ?></div>
    <?php foreach ($posts as $post): ?>
        <article class="post">
            <div class="author-info">
                <div class="container">
                    <div>Foto</div>
                    <div class="author"><a href="<?= URL ?>users/<?= $post->getAuthor()->getUsername() ?>"><?= $post->getAuthor()->getUsername() ?></a></div>
                    <div>Descrição de Usuário</div>
                    <div>Status de Usuário<br>TODO <br>Membro desde <br>Mensagens <br>etc</div>
                </div>
            </div>

            <div class="body">
                <div class="container">
                    <div class="date"><?= $this->date->translateTime($post->getCreationDate(), 1) ?> às <?= $this->date->translateToTime($post->getCreationDate()) ?></div>
                    <div class="content"><?= $post->getContent() ?></div>
                </div>
            </div>
        </article>
    <?php endforeach ?>
    </div>
</section>