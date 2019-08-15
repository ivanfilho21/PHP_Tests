<div class="category"><?= $board->getName() ?></div>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Assunto</th>
            <th>Respostas</th>
            <th>Visualizações</th>
            <th>Última Mensagem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
        <?php $posts = $this->dba->getTable("topics")->getPosts($this->dba, $topic) ?>
        <?php $postsQty = count($posts) ?>
        <tr>
            <td>
                <?php
                $icon = "topic";
                if ($postsQty > 20) {
                    $icon .= "-hot";
                }
                ?>
                <img src="<?= URL ?>assets/img/<?= $icon ?>.ico" alt="Topic Status Icon">
            </td>

            <td width="50%">
                <div>
                    <a href="<?= URL ?>topic/open/<?= $topic->getUrl() ?>" class="title"><?= $topic->getTitle() ?></a>
                    <div>Autor: <a href="<?= URL ?>users/<?= $topic->getAuthor()->getUsername() ?>"><?= $topic->getAuthor()->getUsername() ?></a></div>
                </div>
            </td>

            <td>
                <div><?= $postsQty ?></div>
            </td>

            <td>
                <div><?= $topic->getViews() ?></div>
            </td>

            <td>
                <div>
                <?php if (! empty($posts)): ?>
                    <div>por <a href="<?= URL ?>users/<?= $posts[0]->getAuthor()->getUsername() ?>"><?= $posts[0]->getAuthor()->getUsername() ?></a></div>
                    <div title="<?= $this->date->translateToDateTime($posts[0]->getCreationDate(), "às") ?>"><?= $this->date->translateToDate($posts[0]->getCreationDate()) ?></div>
                <?php else: ?>
                    <div>0</div>
                <?php endif ?>
                </div>
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