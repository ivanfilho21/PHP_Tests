<style>
    .profile {
        display: flex;
        background-color: white;
    }

    .member-info {
        flex: 1;
    }

    .main-info {
        flex: 4;
    }
</style>

<?php $userData = array("user" => $user) ?>

<div class="category-wrapper">
    <section class="profile">
        <section class="member-info">
            <?php $this->requireView("parts/user/user-info", $userData, true) ?>
        </section>

        <main class="main-info">
            <a href="<?= URL ?>profile/edit/<?= $user->getUrl() ?>" class="btn btn-default">Editar Perfil</a>
            <?php $this->requireView("parts/user/signature", $userData, true) ?>
        </main>
    </section>
</div>