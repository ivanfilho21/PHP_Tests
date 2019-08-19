<?php
$topics = $this->dba->getTable("topics")->getAll(array("author_id" => $user->getId()));
$topics = (! empty($topics)) ? $topics : array();

/*for ($i = 0; $i < count($topics); $i++) {
    $post = $this->dba->getTable("posts")->get(array("topic_id" => $topics[$i]->getId()));
    $topics[$i]->setPost($post);
}*/
?>

<style>
    .topics > .item {
        margin-top: 0.25rem;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
</style>

<?php foreach ($topics as $topic): ?>
<?php $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic) ?>
<?php $postsQty = count($posts) ?>
<section class="topics">
    <div class="item flex responsive flex-children-ml">
        <div class="flex-2">
            <div class="title"><a href="<?= URL ?>topics/<?= $topic->getUrl() ?>"><?= $topic->getTitle() ?></a></div>
        </div>

        <div class="flex-1">
            <div><?= $postsQty .plural($postsQty, " Mensagem") ?></div>

            <div style="margin-top: 0.5rem"><?= $topic->getViews() .plural($topic->getViews(), " Visualização") ?></div>
        </div>
    </div>
</section>
<?php endforeach ?>