<?php
$templateCss = array();
$templateJs = array();
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0">
<title><?= $this->title ." | " .SITE_NAME ?></title>

<link rel="stylesheet" href="<?= ASSETS ?>css/reset.css">
<link rel="stylesheet" href="<?= ASSETS ?>css/general.css">

<!-- Template Styles -->
<?php foreach ($templateCss as $style): ?>
<link rel="stylesheet" href="<?= REL_TEMPLATE .$this->template ."/" .$style ?>.css">
<?php endforeach ?>
<!-- View Styles -->
<?php foreach ($this->styles as $style): ?>
<link rel="stylesheet" href="<?= REL_PAGE .$this->controllerName ."css/" .$style ?>.css">
<?php endforeach ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<script src="<?= ASSETS ?>js/ajax.js" defer></script>
<!-- TemplateScripts -->
<?php foreach ($templateJs as $script): ?>
<script src="<?= REL_TEMPLATE .$this->template ."/" .$script ?>.js" defer></script>
<?php endforeach ?>
<!-- View Scripts -->
<?php foreach ($this->scripts as $script): ?>
<script src="<?= REL_PAGE .$this->controllerName ."js/" .$script ?>.js" defer></script>
<?php endforeach ?>

<style>
    header {
        /*color: white;*/
        box-shadow: 0px 0px 10px #222;
        background-image: radial-gradient( circle 484px at 49.4% 19%,  rgba(23,156,214,1) 0%, rgba(52,48,111,1) 100.2% );
    }

    header a {
        color: white;
    }

    header a:hover {
        text-decoration: none;
    }

    header .logo {
        /*background: rgba(34,70,122,1);*/
        /*background-image: radial-gradient( circle 484px at 49.4% 19%,  rgba(23,156,214,1) 0%, rgba(52,48,111,1) 100.2% );*/
        text-align: center;
    }

    header nav {
        /*background: blue;*/
        /*background-image: linear-gradient( 69.5deg,  rgba(40,48,68,1) 2.3%, rgba(1,179,201,1) 97.6% );*/
    }

    header nav ul {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-bottom: 0.25rem;
    }

    header nav a {
        display: block;
        padding: 0.25rem 1rem;
        border-radius: 1.25rem;
        color: white;
        transition: background-color 0.5s;
    }

    header nav a::after {
        content: "";
        display: block;
        width: 0;
        height: 0.15rem;
        margin: 0.25rem auto 0 auto;
        border-radius: 0.5rem;
        background-color: ghostwhite;
        transition: width 0.15s;
    }

    header nav a:hover {
        background-color: rgba(255,255,255,0.2);
        transition: background-color 0.3s;
    }

    header nav a:hover::after {
        width: 100%;
        transition: width 0.3s;
    }

    @media(min-width: 320px) {
        header nav ul {
            flex-direction: row;
        }
    }
</style>
</head>
<body>
<header>
    <div>
        <div class="logo">
            <div class="container">
                <a href="<?php echo URL; ?>" class="h1"><?php echo SITE_NAME; ?></a>
            </div>
        </div>
        
        <nav>
            <ul>
                <li><a href="<?= URL ?>">Home</a></li>
            <?php if (! empty($this->user)): ?>
                <li><a href="<?= URL ?>logout">Sair</a></li>
            <?php else: ?>
                <li><a href="<?= URL ?>register">Criar Conta</a></li>
                <li><a href="<?= URL ?>login">Entrar</a></li>
            <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<section class="container"><?php $this->requireView($view); ?></section></body></html>