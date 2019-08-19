<?php
$posts = $this->dba->getTable("posts")->getAll(array("author_id" => $user->getId()));
?>

<style>
    .posts > .item {
        margin-top: 0.25rem;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
</style>

<?php foreach ($posts as $msg): ?>
<?php $topic = $this->dba->getTable("topics")->get(array("id" => $msg->getTopicId())) ?>
<section class="posts">
    <div class="item flex responsive flex-children-ml">
        <div class="flex-2">
            <div class="title"><a href="<?= URL ?>topics/<?= $topic->getUrl() ?>">Re: <?= $topic->getTitle() ?></a></div>
        </div>
    </div>
</section>
<?php endforeach ?>