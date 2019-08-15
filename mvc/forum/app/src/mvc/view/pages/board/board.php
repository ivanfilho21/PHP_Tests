<div class="category"><?= $board->getName() ?></div>

<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
        <?php
        $where = array("topic_id" => $topic->getId());
        $posts = $this->dba->getTable("posts")->get($where);
        $posts = (! empty($posts)) ? $posts : array();
        ?>
        <tr>
            <td>
                <img src="<?= URL ?>assets/img/topic.ico" alt="Topic Status Icon">
            </td>

            <td width="50%">
                <div>
                    <a href="<?= URL ?>topic/open/<?= $topic->getUrl() ?>" class="title"><?= $topic->getTitle() ?></a>
                    <div>Autor: <a href="<?= URL ?>users/<?= $topic->getAuthor()->getUsername() ?>"><?= $topic->getAuthor()->getUsername() ?></a></div>
                </div>
            </td>

            <td>
                <div>
                <?php if (! empty($posts)): ?>
                    <div>
                        <?= $posts[0]->getTitle() ?>
                    </div>
                <?php else: ?>
                    <div>Não há postagens.</div>
                <?php endif ?>
                </div>
            </td>

            <td>
                <div><?= count($posts) ?> respostas.</div>
            </td>

            <td>
                <div><?= $topic->getViews() ?> visualizações.</div>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div>
    <h4>Legenda</h4>
    <div>
        <img src="<?= URL ?>assets/img/topic.ico" alt="Board Icon" width="24">
        <span>Tópico Normal.</span>
    </div>

    <div>
        <img src="<?= URL ?>assets/img/topic-hot.ico" alt="Board Icon" width="24">
        <span>Tópico Quente (Mais de 20 postagens).</span>
    </div>

    <div>
        <img src="<?= URL ?>assets/img/topic-locked.ico" alt="Board Icon" width="24">
        <span>Tópico Trancado (Não recebe novas postagens).</span>
    </div>

    <div>
        <img src="<?= URL ?>assets/img/topic-fixed.ico" alt="Board Icon" width="24">
        <span>Tópico Fixo.</span>
    </div>
</div>