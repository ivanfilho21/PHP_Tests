<h1>Fórum Index</h1>
<h4>Página de Apresentação</h4>

<?php foreach($categories as $cat): ?>
<div class="category"><?= $cat->getName() ?></div>
<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>                
        <?php foreach($boards as $board): ?>
        <!-- <table> -->
        <?php if ($board->getCategoryId() == $cat->getId()): ?>
        <tr>
            <td class="status-icon" width="24">
                <a href="#" title="10 tópicos não lidos">
                    <img src="<?= URL ?>assets/img/test.ico" alt="Board Status Icon">
                </a>
            </td>

            <td class="board" width="65%">
                <a href="<?= URL ?>boards/<?= $board->getUrl() ?>" class="title"><?= $board->getName() ?></a>
                <div><?= $board->getDescription() ?></div>
                <div>Moderador: <a href="<?= URL ?>users/<?= $board->getModerator()->getUsername() ?>" class="user"><?= $board->getModerator()->getUsername() ?></a></div>
            </td>

            <td width="15%">
                <div><?= $postsQty ?> Mensage<?= ($postsQty == 1) ? "m" : "ns" ?></div>
                <div><?= $topicsQty ?> Tópico<?= ($topicsQty == 1) ? "" : "s" ?></div>
            </td>

            <td width="20%">
                <div class="latest-topic">
                <?php $latestTopic = $board->getLatestTopic() ?>
                <?php $date = \IvanFilho\Date\Date::timeDiff($latestTopic->getCreationDate(), true) ?>
                <?php if (! empty($latestTopic->getTitle())): ?>
                    <a href="<?= URL ?>topics/<?= $latestTopic->getUrl() ?>" class="title"><?= $latestTopic->getTitle() ?></a>
                    <div>por <a href="#" class="user"><?= $latestTopic->getAuthor()->getUsername() ?></a></div>
                    <div>Postado há <?= $date ?>.</div>
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

<div>
    <h4>Legenda</h4>
    <img src="<?= URL ?>assets/img/test.ico" alt="Board Icon" width="32">
    <span>Tópicos não lidos.</span>
</div>