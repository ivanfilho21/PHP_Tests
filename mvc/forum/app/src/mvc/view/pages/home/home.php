<?php foreach($categories as $cat): ?>
<?php $boards = $this->dba->getTable("categories")->getBoards($this->dba, $cat) ?>
    <div class="title title-bar"><?= $cat->getName() ?></div>

    <style>
        .boards {
            background-color: white;
            border: 1px solid #bbb;
        }
        .boards .board {
            padding: 0.5rem 0;
            border-bottom: 1px solid #bbb;
        }
        .boards .board:last-child { border-bottom: 0; }

        .boards .board .top {
            padding: 0 0.5rem;
        }

        .boards .board .content {
            padding: 0 0.5rem;
        }
        .boards .board .latest-topic {
            margin-top: 0.5rem;
            padding: 0 0.5rem;
            border-top: 1px solid #ccc;
        }
    </style>

    <section class="boards">
        <?php foreach ($boards as $board): ?>
        <?php
        $topics = $this->dba->getTable("boards")->getTopics($this->dba, $board);
        $topicsQty = count($topics);
        $postsQty = 0;

        foreach ($topics as $t) {
            $posts = $this->dba->getTable("topics")->getPosts($this->dba, $t);
            $postsQty += count($posts);
        }
        ?>
        <div class="board">
            <div class="top flex justify-content-spc-btw">
                <div class="flex flex-children-ml">
                    <span class="icon"><i class="fa fa-folder"></i></span>
                    <div class="title"><a href="<?= URL ?>boards/<?= $board->getUrl() ?>"><?= $board->getName() ?></a></div>
                </div>

                <div class="flex flex-children-ml">
                    <span class="icon" title="Tópicos"><i class="fa fa-list-alt"></i> <?= $topicsQty ?></span>
                    <span class="icon" title="Mensagens"><i class="fa fa-comments"></i> <?= $postsQty ?></span>
                </div>
            </div>

            <div class="content">
                <div class="description"><?= $board->getDescription() ?></div>
                <div class="caption">Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="caption"><?= $board->getModerator()->getUsername() ?></a></div>
            </div>

            <!-- <div class="latest-topic">
            <?php $latestTopic = $board->getLatestTopic() ?>
            <?php $date = $this->date->translateTime($latestTopic->getCreationDate(), 1) ?>
            <?php $time = $this->date->translateToTime($latestTopic->getCreationDate()) ?>
            <?php if (! empty($latestTopic->getTitle())): ?>
                <a href="<?= URL ?>topics/<?= $latestTopic->getUrl() ?>" class="title"><?= $latestTopic->getTitle() ?></a>
                <div>por <a href="<?= URL ?>users/<?= $latestTopic->getAuthor()->getUrl() ?>" class="user"><?= $latestTopic->getAuthor()->getUsername() ?></a></div>
                <div><?= $date ?> às <?= $time ?>.</div>
            <?php else: ?>
                <div>Não há tópicos.</div>
            <?php endif ?>
            </div> -->
        </div>
        <?php endforeach ?>
    </section>
    
    <table>
        <thead>
            <tr>
                <th></th>
                <th class="text-align-left"><!-- Discussões --></th>
                <th><!-- Tópicos --></th>
                <th><!-- Mensagens --></th>
                <th class="text-align-left"><!-- Último Tópico --></th>
            </tr>
        </thead>
        <tbody>                
            <?php foreach($boards as $board): ?>
            <!-- <table> -->
            <?php if ($board->getCategoryId() == $cat->getId()): ?>
            <tr>
                <td class="status-icon" width="24">
                    <span><i class="fa fa-folder"></i></span>
                </td>

                <td class="text-align-left" width="65%">
                    <a href="<?= URL ?>boards/<?= $board->getUrl() ?>" class="subtitle"><?= $board->getName() ?></a>
                    <div><?= $board->getDescription() ?></div>
                    <div>Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="user"><?= $board->getModerator()->getUsername() ?></a></div>
                </td>

                <td>
                    <div><?= $postsQty ?><span class="caption"><?= plural($postsQty, " Mensagem") ?></span></div>
                </td>

                <td>
                    <div><?= $topicsQty ?><span class="caption"><?= plural($topicsQty, " Tópico") ?></span></div>
                </td>

                <td width="25%">
                    <div class="latest-topic text-align-left">
                    <?php $latestTopic = $board->getLatestTopic() ?>
                    <?php $date = $this->date->translateTime($latestTopic->getCreationDate(), 1) ?>
                    <?php $time = $this->date->translateToTime($latestTopic->getCreationDate()) ?>
                    <?php if (! empty($latestTopic->getTitle())): ?>
                        <a href="<?= URL ?>topics/<?= $latestTopic->getUrl() ?>" class="title"><?= $latestTopic->getTitle() ?></a>
                        <div>por <a href="<?= URL ?>users/<?= $latestTopic->getAuthor()->getUrl() ?>" class="user"><?= $latestTopic->getAuthor()->getUsername() ?></a></div>
                        <div><?= $date ?> às <?= $time ?>.</div>
                    <?php else: ?>
                        <div>Não há tópicos.</div>
                    <?php endif ?>
                    </div>
                </td>
            </tr>
            <?php endif ?>
            <?php endforeach ?>
            <!-- </table> -->
        </tbody>
    </table>

<?php endforeach ?>

<!-- <div class="category-wrapper" style="margin-top: 1rem; background-color: ghostwhite;">
    <div class="container-wider flex flex-direction-col">
        <h4 style="margin-top: 0">Legenda</h4>

        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/board.ico" alt="Board Icon" width="24">
            <span>Não há novas mensagens.</span>
        </div>
        
        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/board-messages.ico" alt="Board Icon" width="24">
            <span>Há novas mensagens.</span>
        </div>
    </div>
</div> -->