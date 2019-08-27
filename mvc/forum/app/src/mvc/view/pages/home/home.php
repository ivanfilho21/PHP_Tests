<style>

    .category {
        margin: 0rem;
        margin-bottom: 1rem;
    }
    .boards .board { border-bottom: 1px solid #ccc; }
    .boards .board:last-child { border-bottom: none; }

    @media(min-width: 700px) {
        .boards .board .bottom {
            display: flex;
            flex-direction: row;
        }

        .boards .board .latest-topic {
            align-items: center;
            border-left: 1px solid #eee;
        }
    }
</style>

<?php foreach($categories as $cat): ?>
<section class="category card">
<?php $boards = $this->dba->getTable("categories")->getBoards($this->dba, $cat) ?>
    <div class="dark flex flex-children-ml p-0.5">
        <span class="icon"><i class="fa fa-folder"></i></span>
        <span class="title"><?= $cat->getName() ?></span>
    </div>
    <section class="boards">
<?php if (empty($boards)): ?>
        <div class="board p-tb-0.5">
            <div class=" p-0.5">Ainda não há discussões.</div>
        </div>
<?php else: ?>
    <?php foreach ($boards as $board): ?>
        <div class="board p-tb-0.5">
    <?php if (empty($board->getName())): ?>
            <div class="p-lr-0.5">Ainda não há tópicos.</div>
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
            <div class="flex justify-content-spc-btw p-lr-0.5">
                <div class="flex flex-children-ml">
                    <span class="icon"><i class="fa fa-chalkboard"></i></span>
                    <div class="title"><a href="<?= URL ?>boards/<?= $board->getUrl() ?>"><?= $board->getName() ?></a></div>
                </div>

                <div class="flex flex-children-ml">
                    <span class="icon" title="Tópicos"><i class="fa fa-list-alt"></i> <?= $topicsQty ?></span>
                    <span class="icon" title="Mensagens"><i class="fa fa-comments"></i> <?= $postsQty ?></span>
                </div>
            </div>

            <div class="bottom">
                <div class="flex-3">
                    <div class="content p-lr-0.5">
                        <div class="description"><?= $board->getDescription() ?></div>
                        <div class="caption">Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="caption"><?= $board->getModerator()->getUsername() ?></a></div>
                    </div>
                </div>

                <div class="latest-topic flex-1 p-lr-0.5" style="margin-top: 0.5rem">
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
</section>
<?php endforeach ?>