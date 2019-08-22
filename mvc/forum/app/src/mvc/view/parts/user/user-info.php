<?php

$profilePicture = (! empty($user->getImage())) ? $user->getImage() : ASSETS ."img/no-profile-picture.png";

$type = "";
switch($user->getType()) {
    case \User::TYPE_NORMAL_USER: $type = "Membro"; break;
    case \User::TYPE_MODERATOR_USER: $type = "Moderador"; break;
    case \User::TYPE_ADMIN_USER: $type = "Administrador"; break;
}
$topics = $this->dba->getTable("topics")->getAll(array("author_id" => $user->getId()));
$topics = (! empty($topics)) ? count($topics) : 0;

$posts = $this->dba->getTable("posts")->getAll(array("author_id" => $user->getId()));
$msg = (! empty($posts)) ? count($posts) : 0;

$likes = 0;
foreach ($posts as $post) {
    $l = $this->dba->getTable("likes")->getAll(array("post_id" => $post->getId()));
    $likes += (! empty($l)) ? count($l) : 0;
}

$stats["msg"] = $msg;
$stats["likes"] = $likes;
$stats["topics"] = $topics;
?>

<style>
    .user-info {
        flex: 1;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .user-info div {
        margin-bottom: 0.5rem;
    }
    .user-info div:last-child {
        margin-bottom: 0;
    }

    .user-info .user {
        text-align: center;
    }

    .user-info .type {
        /*margin-bottom: 0.75rem;*/
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        text-align: center;
        border: 2px dotted #ccc;
    }

    .picture {
        width: 120px;
        margin: 0 auto;
        text-align: center;
        border: ridge #ccc;
        border-radius: 50%;
        overflow: hidden;
    }

    .description {
        text-align: center;
    }

    .statistics {
        /*background-color: lightgray;*/
    }
    
    .statistics .item {
        display: flex;
        justify-content: space-between;
    }
</style>

<section class="user-info">
    <div class="user">
        <a href="<?= URL ?>users/<?= $user->getUsername() ?>"><?= $user->getUsername() ?></a>
    </div>

    <div class="picture"><img src="<?= $profilePicture ?>" alt="Foto de Perfil"></div>


    <div class="description"><?= (empty($user->getDescription())) ? "" : "<span class='quotes'>" .$user->getDescription() ."</span>" ?></div>

    <div class="type"><i class="fa fa-user-alt"></i> <?= $type ?></div>
    
    <div class="flex flex-children-ml align-items-center justify-content-center">
        <span title="<?= $user->getUsername() ?> criou <?= $stats["topics"] .plural($stats["topics"], " tópico") ?>"><i class="fa fa-list-alt"></i> <?= $stats["topics"] ?></span>

        <span title="<?= $user->getUsername() ?> escreveu <?= $stats["msg"] .plural($stats["msg"], " mensagem") ?>"><i class="fa fa-comments"></i> <?= $stats["msg"] ?></span>
        
        <span title="<?= $user->getUsername() ?> recebeu <?= $stats["likes"] .plural($stats["likes"], " like") ?> em suas mensagens"><i class="fa fa-thumbs-up"></i>  <?= $stats["likes"] ?></span>
    </div>
</section>