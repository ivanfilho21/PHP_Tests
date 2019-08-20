<style>
    .boards {
        background-color: white;
    }

    .boards .board .top {
        padding: 0.5rem;
        border-bottom: 1px solid #ccc;
        background-color: ghostwhite;
        border: 1px solid #bbb;
        border-top: none;
        border-bottom: none;
    }
    .boards .board .top:first-child { border: none; }
    .boards .board:last-child { border-bottom: 1px solid #bbb; }

    .boards .board .bottom {
        display: flex;
        flex-direction: column;
        border: 1px solid #bbb;
        border-top: none;
        border-bottom: none;
    }

    .boards .board .content,
    .boards .board .description {
        margin: 0;
        margin-bottom: 0.3rem;
    }
    .boards .board .content {
        padding: 0.5rem;
    }

    .boards .board .latest-topic {
        flex: 1;
        display: flex;
        padding: 0 0.5rem 0.5rem 0.5rem;
        
    }

    @media(min-width: 700px) {
        .boards .board .bottom {
            display: flex;
            flex-direction: row;
        }

        .boards .board .latest-topic {
            align-items: center;
            padding: 0.5rem;
            border-left: 1px solid #ccc;
        }
    }
</style>

<?php foreach($categories as $cat): ?>
<?php $boards = $this->dba->getTable("categories")->getBoards($this->dba, $cat) ?>
    <div class="title title-bar dark"><?= $cat->getName() ?></div>
    <section class="boards">
<?php if (empty($boards)): ?>
    <div style="padding: 0.5rem">Ainda não há discussões.</div>
<?php else: ?>
    <?php foreach ($boards as $board): ?>
        <div class="board">
    <?php if (empty($board->getName())): ?>
        <div class="top">Ainda não há tópicos.</div>
    <?php else: ?>
        <?php
        $topics = $this->dba->getTable("boards")->getTopics($this->dba, $board);
        $topicsQty = count($topics);
        $postsQty = 0;

        foreach ($topics as $t) {
            $posts = $this->dba->getTable("topics")->getPosts($this->dba, $t);
            $postsQty += count($posts);
        }
        ?>
            <div class="top dark flex justify-content-spc-btw">
                <div class="flex flex-children-ml">
                    <span class="icon"><i class="fa fa-folder"></i></span>
                    <div class="title"><a href="<?= URL ?>boards/<?= $board->getUrl() ?>"><?= $board->getName() ?></a></div>
                </div>

                <div class="flex flex-children-ml">
                    <span class="icon" title="Tópicos"><i class="fa fa-list-alt"></i> <?= $topicsQty ?></span>
                    <span class="icon" title="Mensagens"><i class="fa fa-comments"></i> <?= $postsQty ?></span>
                </div>
            </div>

            <div class="bottom">
                <div class="flex-3">
                    

                    <div class="content">
                        <div class="description"><?= $board->getDescription() ?></div>
                        <div class="caption">Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="caption"><?= $board->getModerator()->getUsername() ?></a></div>
                    </div>
                </div>

                <div class="latest-topic flex-1">
                <?php $latestTopic = $board->getLatestTopic() ?>
                <?php $date = $this->date->translateTime($latestTopic->getCreationDate(), 1) ?>
                <?php $time = $this->date->translateToTime($latestTopic->getCreationDate()) ?>
                <?php if (! empty($latestTopic->getTitle())): ?>
                    <span>
                        <a href="<?= URL ?>topics/<?= $latestTopic->getUrl() ?>"><?= $latestTopic->getTitle() ?></a>
                        <span>por <a href="<?= URL ?>users/<?= $latestTopic->getAuthor()->getUrl() ?>" class="user"><?= $latestTopic->getAuthor()->getUsername() ?></a></span>
                        <span><?= $date ?> às <?= $time ?>.</span>
                    </span>
                <?php else: ?>
                    <div>Não há tópicos.</div>
                <?php endif ?>
                </div>
            </div>
    <?php endif ?>
        </div>
    <?php endforeach ?>
<?php endif ?>
    </section>
    <br>
<?php endforeach ?>