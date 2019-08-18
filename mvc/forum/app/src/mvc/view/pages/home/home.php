<?php foreach($categories as $cat): ?>

<div class="category-wrapper">
    <div class="category"><?= $cat->getName() ?></div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th class="text-align-left">Discussões</th>
                <th>Estatísticas</th>
                <th class="text-align-left">Último Tópico</th>
            </tr>
        </thead>
        <tbody>                
            <?php foreach($boards as $board): ?>
            <!-- <table> -->
            <?php if ($board->getCategoryId() == $cat->getId()): ?>
            <tr>
                <td class="status-icon" width="24">
                    <a title="Não há novas mensagens"><img src="<?= URL ?>assets/img/board.ico" alt="Board Status Icon"></a>
                </td>

                <td class="text-align-left" width="65%">
                    <a href="<?= URL ?>boards/<?= $board->getUrl() ?>" class="title"><?= $board->getName() ?></a>
                    <div><?= $board->getDescription() ?></div>
                    <div>Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="user"><?= $board->getModerator()->getUsername() ?></a></div>
                </td>

                <td>
                    <div><?= $postsQty .plural($postsQty, " Mensagem") ?></div>
                    <div><?= $topicsQty .plural($topicsQty, " Tópico") ?></div>
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
</div>

<?php endforeach ?>

<div class="category-wrapper" style="margin-top: 1rem; background-color: ghostwhite;">
    <div class="container-wider">
        <h4 style="margin-top: 0">Legenda</h4>

        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/board.ico" alt="Board Icon" width="32">
            <span>Não há novas mensagens.</span>
        </div>
        
        <div class="flex align-items-center flex-children-ml">
            <img src="<?= URL ?>assets/img/board-messages.ico" alt="Board Icon" width="32">
            <span>Há novas mensagens.</span>
        </div>
    </div>
</div>