<?php
$type = "";
switch($user->getType()) {
    case \User::TYPE_NORMAL_USER: $type = "Membro"; break;
    case \User::TYPE_MODERATOR_USER: $type = "Moderador"; break;
    case \User::TYPE_ADMIN_USER: $type = "Administrador"; break;
}
?>

<div class="title" style="margin-top: 0.5rem">Sobre:</div>

<div style="margin-left: 1rem; margin-top: 0.75rem">Tipo de Usuário: <?= $type ?></div>
<div style="margin-left: 1rem; margin-top: 0.35rem">Membro desde: <?= $this->date->translateToDate($user->getCreationDate()) ?></div>
<br>

<div class="title">Assinatura:</div>
<hr>
<div class="container"><?php $this->requireView("parts/user/signature", array("user" => $user), true) ?></div>