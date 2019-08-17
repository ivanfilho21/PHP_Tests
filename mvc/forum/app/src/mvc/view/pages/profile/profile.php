<?php $userData = array("user" => $user) ?>

<section>
    <?php $this->requireView("parts/user/user-info", $userData, true) ?>
</section>

<main>
    <?php $this->requireView("parts/user/signature", $userData, true) ?>
</main>