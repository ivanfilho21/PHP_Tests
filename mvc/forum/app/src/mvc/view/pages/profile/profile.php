<?php $viewData = array("user" => $user) ?>

<section>
    <?php $this->requireView("parts/user/user-info", $viewData, true) ?>
</section>

<main>
    <?php $this->requireView("parts/user/signature", $viewData, true) ?>
</main>