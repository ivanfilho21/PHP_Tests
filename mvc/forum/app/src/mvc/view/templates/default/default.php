<?php
$this->styles[] = array("path" => REL_TEMPLATE .$this->template ."/css/", "name" => "win98-header");
$this->styles[] = array("path" => REL_TEMPLATE .$this->template ."/css/", "name" => "footer");
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0">
<title><?= ((! empty($this->title)) ? $this->title ." | " : "") .SITE_NAME ?></title>

<!-- Styles -->
<link rel="stylesheet" href="<?= ASSETS ?>css/reset.css">
<link rel="stylesheet" href="<?= ASSETS ?>css/general.css">
<?php foreach ($this->styles as $style): ?>
<link rel="stylesheet" href="<?= $style["path"] .$style["name"] ?>.css">
<?php endforeach ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<!-- Scripts -->
<script src="<?= ASSETS ?>js/ajax.js" defer></script>
<?php foreach ($this->scripts as $script): ?>
<script src="<?= $script["path"] .$script["name"] ?>.js"<?= (isset($script["defer"])) ? " defer" : "" ?>></script>
<?php endforeach ?>
</head>
<body>
<header>
    <div>
        <div class="logo">
            <div class="container">
                <a href="<?= URL ?>" class="h1"><?= SITE_NAME ?></a>
            </div>
        </div>
        
        <nav>
            <ul>
                <li><a href="<?= URL ?>">Início</a></li>
            <?php if (! empty($this->user)): ?>
                <li><a href="<?= URL ?>users/<?= $this->user->getUrl() ?>"><?= $this->user->getUsername() ?></a></li>
                <li><a href="<?= URL ?>topic/create">Novo Tópico</a></li>
                <li><a href="<?= URL ?>logout">Sair</a></li>
            <?php else: ?>
                <li><a href="<?= URL ?>register">Criar Conta</a></li>
                <li><a href="<?= URL ?>login">Entrar</a></li>
            <?php endif ?>
            </ul>
        </nav>
    </div>
</header>

<section class="container">
    <?php if ($this->showMainPanel): ?>
    <section class="main-options">
        <?php $this->requireView("parts/navigation", null, true) ?>
    </section>
    <?php endif ?>
    <?php $this->requireView($view, $data) ?>
</section>

<footer>
    <div class="container">
        <div class="site-credit"><a href="<?= URL ?>"><?= SITE_NAME ?></a></div>
    </div>
</footer>
</body></html>