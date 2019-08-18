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
            <?php if (! empty($this->user) && $this->user->getId() == $user->getId()): ?>
            <a href="<?= URL ?>profile" class="btn btn-default">Editar Perfil</a>
            <?php endif ?>
            <?php $this->requireView("parts/user/signature", $userData, true) ?>
        </main>
    </section>
</div>