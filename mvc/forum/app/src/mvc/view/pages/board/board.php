<div class="category-wrapper">
    <div class="category"><?= $board->getName() ?></div>
    
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
</div>

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
</div>