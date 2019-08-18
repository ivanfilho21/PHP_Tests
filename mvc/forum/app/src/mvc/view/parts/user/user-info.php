<?php

$type = "";
switch($user->getType()) {
    case \User::TYPE_NORMAL_USER: $type = "Membro"; break;
    case \User::TYPE_MODERATOR_USER: $type = "Moderador"; break;
    case \User::TYPE_ADMIN_USER: $type = "Administrador"; break;
}

$posts = $this->dba->getTable("posts")->getAll(array("author_id" => $user->getId()));
$msg = (! empty($posts)) ? count($posts) : 0;

$likes = 0;
foreach ($posts as $post) {
    $l = $this->dba->getTable("likes")->getAll(array("post_id" => $post->getId()));
    $likes += (! empty($l)) ? count($l) : 0;
}


$stats["msg"] = $msg;
$stats["likes"] = $likes;
?>

<style>
    .user-info {
        flex: 1;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
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
        text-align: center;
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
    <div class="picture">Foto</div>

    <div class="user">
        <a href="<?= URL ?>users/<?= $user->getUsername() ?>"><?= $user->getUsername() ?></a>
    </div>

    <div class="description">Descrição de Usuário</div>

    <div class="type"><i class="fa fa-user-alt"></i> <?= $type ?></div>

    <div class="statistics">

        <div class="flex flex-children-ml align-items-center justify-content-center">
            <span title="<?= $user->getUsername() ?> escreveu <?= $stats["msg"] .plural($stats["msg"], " mensagem") ?>"><i class="fa fa-comments"></i> <?= $stats["msg"] ?></span>
            
            <span title="<?= $user->getUsername() ?> recebeu <?= $stats["likes"] .plural($stats["likes"], " like") ?>"><i class="fa fa-thumbs-up"></i>  <?= $stats["likes"] ?></span>
        </div>
        
        <div class="item">Visto por Último -</div>
        
        <div class="item">Registrado em <?= $this->date->translateToDate($user->getCreationDate()) ?></div>
    </div>
</section>