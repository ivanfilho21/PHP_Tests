<style>
    .topics {
        background-color: white;
    }

    .topics .topic { border-bottom: 1px solid #ccc; }
    .topics .topic:last-child { border-bottom: none; }

    @media(min-width: 700px) {
        .topics .topic .bottom {
            display: flex;
            flex-direction: row;
        }

        .topics .topic .latest-msg {
            align-items: center;
            border-left: 1px solid #eee;
        }
    }
</style>

<div class="dark flex flex-children-ml p-0.5">
    <span class="icon"><i class="fa fa-chalkboard"></i></span>
    <span class="title"><?= $board->getName() ?></span>
</div>

<section class="topics">
<?php if (empty($topics)): ?>
    <div class="topic p-tb-0.5">
        <div class="p-0.5">Ainda não há tópicos.</div>
    </div>
<?php else: ?>
    <?php foreach ($topics as $topic): ?>
    <?php $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic) ?>
    <?php $postsQty = count($posts) ?>
        <div class="topic p-tb-0.5">
            <div class="flex justify-content-spc-btw p-lr-0.5">
                <div class="flex flex-children-ml">
                    <span class="icon"><i class="fa fa-chalkboard"></i></span>
                    <div class="title"><a href="<?= URL ?>topics/<?= $topic->getUrl() ?>" class="title"><?= $topic->getTitle() ?></a></div>
                </div>

                <div class="flex flex-children-ml">
                    <span title="Mensagens"><i class="fa fa-comments"></i> <?= $postsQty ?></span>
                    <span title="Visualizações"><i class="fa fa-eye"></i> <?= $topic->getViews() ?></span>
                </div>
            </div>

            <div class="bottom">
                <div class="flex-3">
                    <div class="content p-lr-0.5">
                        <div class="description"><?= $board->getDescription() ?></div>
                        <div class="caption">Autor: <a href="<?= URL ?>users/<?= $topic->getAuthor()->getUsername() ?>" class="caption"><?= $topic->getAuthor()->getUsername() ?></a></div>
                    </div>
                </div>

                <div class="latest-msg flex-1 p-lr-0.5" style="margin-top: 0.5rem">
                <?php if (! empty($posts)): ?>
                    <div>Última mensagem por <a href="<?= URL ?>users/<?= $posts[$postsQty-1]->getAuthor()->getUsername() ?>"><?= $posts[$postsQty-1]->getAuthor()->getUsername() ?></a> em <?= $this->date->translateTime($posts[$postsQty-1]->getCreationDate(), 1) ?> às <?= $this->date->translateToTime($posts[$postsQty-1]->getCreationDate()) ?></div>
                <?php else: ?>
                    <div>0</div>
                <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
</section>
<!-- 
<br>
<table>
    <thead>
        <tr>
            <th></th>
            <th class="text-align-left">Assunto</th>
            <th>Estatíticas</th>
            <th class="text-align-left">Última Mensagem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
        <?php $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic) ?>
        <?php $postsQty = count($posts) ?>
        <tr>
            <td>
                <?php

                $topicIcon = "topic";
                if ($topic->getMode() == \Topic::MODE_LOCKED_TOPIC) {
                    $topicIcon .= "-locked";
                } elseif ($postsQty >= 10) {
                    $topicIcon .= "-hot";
                }
                ?>
                <img src="<?= URL ?>assets/img/<?= $topicIcon ?>.ico" alt="Topic Status Icon">
            </td>

            <td width="50%" class="text-align-left">
                <div>
                    <a href="<?= URL ?>topics/<?= $topic->getUrl() ?>" class="title"><?= $topic->getTitle() ?></a>
                    <div>Autor: <a href="<?= URL ?>users/<?= $topic->getAuthor()->getUsername() ?>"><?= $topic->getAuthor()->getUsername() ?></a></div>
                </div>
            </td>

            <td>
                <div><?= $postsQty .plural($postsQty, " Mensagem") ?></div>
                <div><?= $topic->getViews() .plural($topic->getViews(), " Visualização") ?></div>
            </td>
                

            <td class="text-align-left">
                <div>
                <?php if (! empty($posts)): ?>
                    <div>por <a href="<?= URL ?>users/<?= $posts[$postsQty-1]->getAuthor()->getUsername() ?>"><?= $posts[$postsQty-1]->getAuthor()->getUsername() ?></a></div>
                    <div title="<?= $this->date->translateToDateTime($posts[$postsQty-1]->getCreationDate(), "às") ?>"><?= $this->date->translateTime($posts[$postsQty-1]->getCreationDate(), 1) ?> às <?= $this->date->translateToTime($posts[$postsQty-1]->getCreationDate()) ?></div>
                <?php else: ?>
                    <div>0</div>
                <?php endif ?>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php $this->requireView("parts/pagination", array("page" => $page, "pages" => $pages, "baseUrl" => $baseUrl), true) ?>

<div class="category-wrapper" style="margin-top: 1rem; background-color: ghostwhite;">
    <div class="container-wider flex flex-direction-col">
        <h4 style="margin-top: 0">Legenda</h4>

        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/topic.ico" alt="Board Icon" width="24">
            <span>Tópico Normal.</span>
        </div>
        
        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/topic-hot.ico" alt="Board Icon" width="24">
            <span>Tópico Quente (Mais de 20 mensagens).</span>
        </div>

        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/topic-locked.ico" alt="Board Icon" width="24">
            <span>Tópico Trancado (Não recebe novas mensagens).</span>
        </div>
    </div>
</div> -->