<style>
    .user-info {
        flex: 1;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .user-info .user {
        margin-bottom: 0.75rem;
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        text-align: center;
        border: 2px dotted #ccc;
    }

    .picture {
        text-align: center;
    }

    .description {
        text-align: center;
    }

    .statistics {
        /*background-color: lightgray;*/
    }
    
    .statistics .item {
        display: flex;
        justify-content: space-between;
    }
</style>

<section class="user-info">
    <div class="picture">Foto</div>

    <div class="user">
        <a href="<?= URL ?>users/<?= $user->getUsername() ?>"><?= $user->getUsername() ?></a>
    </div>

    <div class="description">Descrição de Usuário</div>

    <div class="statistics">

        <div class="item">
            <span>Tipo de Usuário</span>
            <span><?= $user->getType() ?></span>
        </div>

        <div class="item">
            <span>Visto por Último</span>
            <span>-</span>
        </div>

        <div class="item">
            <span>Mensagens</span>
            <span>-</span>
        </div>

        <div class="item">
            <span>Likes Recebidos</span>
            <span>-</span>
        </div>
        
        <div class="item">
            <span>Membro desde</span>
            <span><?= $this->date->translateToDate($user->getCreationDate()) ?></span>
        </div>
    </div>
</section>