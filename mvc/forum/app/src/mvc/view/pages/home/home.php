<h1>Fórum Index</h1>
<h4>Página de Apresentação</h4>

<?php foreach($categories as $cat): ?>
<div class="category"><?php echo $cat->getName(); ?></div>
<table>
    <thead>
        <tr>
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
                    <img src="<?php echo URL; ?>assets/img/test.ico" alt="Board Status Icon">
                </a>
            </td>

            <td class="board" width="70%">
                <a href="<?php echo URL; ?>board/<?php echo $board->getUrl() ?>" class="title"><?php echo utf8_encode($board->getName()); ?></a>
                <div><?php echo utf8_encode($board->getDescription()); ?></div>
                <div>Moderador: <a href="<?php echo URL; ?>users/<?php echo $board->getModerator()->getUsername(); ?>" class="user"><?php echo $board->getModerator()->getUsername(); ?></a></div>
            </td>

            <td width="30%">
                <div class="latest-topic">
                <?php $latestTopic = $board->getLatestTopic(); ?>
                <?php $date = \IvanFilho\Date\Date::timeDiff( $latestTopic->getCreationDate(), true ); ?>
                <?php if (! empty($latestTopic->getTitle())): ?>
                    <a href="#" class="title"><?php echo utf8_encode($board->getLatestTopic()->getTitle()); ?></a>
                    <div>por <a href="#" class="user"><?php echo $latestTopic->getAuthor()->getUsername(); ?></a></div>
                    <div>Postado há <?php echo $date; ?>.</div>
                    <!-- <div>por <a href="#" class="user"><?php #echo $latestTopic->getAuthor()->getUsername(); ?></a></div> -->
                    <!-- <div>Postado em <?php #echo date("d/m/Y", strtotime($latestTopic->getCreationDate())); ?>, às <?php #echo date("G:i", strtotime($latestTopic->getCreationDate())); ?>.</div> -->
                <?php else: ?>
                    <div>Não há tópicos.</div>
                <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <!-- </table> -->
    </tbody>
</table>
<?php endforeach; ?>

<div>
    <h4>Legenda</h4>
    <img src="<?php echo URL; ?>assets/img/test.ico" alt="Board Icon" width="32">
    <span>Tópicos não lidos.</span>
</div>