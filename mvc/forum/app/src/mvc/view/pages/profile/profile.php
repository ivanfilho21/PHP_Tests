<style>
    .profile {
        display: flex;
        background-color: white;
    }

    .member-info {
        flex: 1;
    }

    .main-info {
        flex: 4;
    }

    .sections {
        border-bottom: 1px solid #999;
    }
    .sections li {
        /*margin-left: 1rem;*/
        border: 1px solid #999;
        border-bottom: none;
    }
    .sections li.active {
        background-color: #ccc;
    }
    .sections li.active a {
        font-weight: bold;
        color: #444;
    }
    .sections li a {
        display: block;
        padding: 0.25rem 0.75rem;
    }

    .qty { margin-left: 0.25rem; }
    .qty::before { content: "("; }
    .qty::after { content: ")"; }

    .info {

    }

</style>

<?php
$userData = array();
$lastDate = $this->date->translateTime($user->getLastSeen(), 1);
$lastTime = $this->date->translateToTime($user->getLastSeen());
$userData["lastDate"] = $lastDate;
$userData["lastTime"] = $lastTime;
$userData["user"] = $user;

$topics = $this->dba->getTable("topics")->getAll(array("author_id" => $user->getId()));
$topics = (! empty($topics)) ? count($topics) : 0;

$posts = $this->dba->getTable("posts")->getAll(array("author_id" => $user->getId()));
$msg = (! empty($posts)) ? count($posts) : 0;
?>

<div class="category-wrapper">
    <section class="profile">
        <section class="member-info">
            <?php $this->requireView("parts/user/user-info", $userData, true) ?>
        </section>

        <main class="main-info">
            <div class="flex justify-content-spc-btw">
                <div>
                    <h1><?= $user->getUsername() ?></h1>
                    <div class="item">Visto por Último: <span><?= (empty($lastDate) || empty($lastTime)) ? "Nunca" : $lastDate ." às " .$lastTime ?></span></div>
                </div>
                <div>
                    <div style="margin: 1rem"><?php if (! empty($this->user) && $this->user->getId() == $user->getId()): ?><a href="<?= URL ?>profile" class="btn btn-default">Editar Perfil</a>
                    <?php endif ?></div>
                </div>
            </div>
            <hr style="margin-top: 0.5rem"><br>

            <nav class="sections">
                <ul class="flex responsive">
                    <li <?= ($section == "basic-info") ? "class='active'" : "" ?>><a href="<?= URL ?>users/<?= $user->getUrl() ?>/basic-info">Dados</a></li>
                    <li <?= ($section == "topics") ? "class='active'" : "" ?>><a href="<?= URL ?>users/<?= $user->getUrl() ?>/topics">Tópicos<span class="qty"><?= $topics ?></span></a></li>
                    <li <?= ($section == "posts") ? "class='active'" : "" ?>><a href="<?= URL ?>users/<?= $user->getUrl() ?>/posts">Mensagens<span class="qty"><?= $msg ?></span></a></li>
                </ul>
            </nav>

            <section class="container-wider">
                <?php $this->requireView($section, $userData) ?>
            </section>
        </main>
    </section>
</div>