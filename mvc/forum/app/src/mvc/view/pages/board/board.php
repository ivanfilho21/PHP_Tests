<h1><?php echo $board->getName(); ?></h1>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Título</th>
            <th>Último Post</th>
            <th>Respostas (qty)</th>
            <th>Visualizações (qty)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
        <tr>
            <td>
                <img src="<?php echo URL; ?>assets/img/topic.ico" alt="Topic Status Icon">
            </td>

            <td width="60%">
                <div>
                    <a href="#"><?php echo utf8_encode($topic->getTitle()); ?></a>
                    <p>Autor: <a href="<?php echo URL; ?>users/<?php echo $topic->getAuthor()->getUsername(); ?>"><?php echo $topic->getAuthor()->getUsername(); ?></a></p>
                </div>
            </td>

            <td>
                ...
            </td>

            <td>
                ...
            </td>

            <td>
                <p>...<?php #echo $topic->getViews(); ?></p>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div>
    <h4>Legenda</h4>
    <div>
        <img src="<?php echo URL; ?>assets/img/topic.ico" alt="Board Icon" width="24">
        <span>Tópico Normal.</span>
    </div>

    <div>
        <img src="<?php echo URL; ?>assets/img/topic-hot.ico" alt="Board Icon" width="24">
        <span>Tópico Quente (Mais de 20 postagens).</span>
    </div>

    <div>
        <img src="<?php echo URL; ?>assets/img/topic-locked.ico" alt="Board Icon" width="24">
        <span>Tópico Trancado (Não recebe novas postagens).</span>
    </div>

    <div>
        <img src="<?php echo URL; ?>assets/img/topic-fixed.ico" alt="Board Icon" width="24">
        <span>Tópico Fixo.</span>
    </div>
</div>