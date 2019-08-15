<style>
    .topic .title {
        font-size: 1.25rem;
        padding: 0.5rem 1rem;
        background-color: #333;
        color: ghostwhite;
    }
    .post {
        display: flex;
        flex-wrap: wrap;
    }

    .post .author-info {
        flex: 1;
    }

    .post .body {
        flex: 4;
    }

    .post .author {
        margin-bottom: 0.75rem;
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        text-align: center;
        border: 1px dotted;
    }
</style>

<section class="topic">
    <div class="title"><?= $topic->getTitle() ?></div>
    
    <article class="post">
        <div class="author-info">
            <div class="container">
                <div class="author"><?= $author->getUsername() ?></div>
                <div>Status de Usuário<br>TODO</div>
            </div>
        </div>

        <div class="body">
            <div class="container">
                <div class="date"><?= date("d/m/Y", strtotime($topic->getCreationDate())) ?></div>
                <div class="content"><?= $topic->getContent() ?></div>
            </div>
        </div>
    </article>


</section>