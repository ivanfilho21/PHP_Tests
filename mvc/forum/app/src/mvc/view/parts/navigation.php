<style>
    .breadcrumb-nav {
        padding: 0.5rem;
        color: #176093;
    }

    .breadcrumb-nav ul {
        display: flex;
        font-size: 0.9rem;
    }

    .breadcrumb-nav li {
        overflow: hidden;
        white-space: nowrap;
    }

    .breadcrumb-nav li a {
        /*color: #176093;*/
    }

    .breadcrumb-nav li.active a {
        /*font-style: italic;*/
        font-weight: bold;
        /*color: red;*/
    }

    .breadcrumb-nav li::before {
        content: "▶";
        position: relative;
        top: -15%;
        font-size: 0.6rem;
        margin: 0.5rem;
    }
    .breadcrumb-nav li:first-child::before {
        content: "";
        display: none;
    }
    .breadcrumb-nav li:last-child::after {
        content: "";
    }
</style>

<nav class="breadcrumb-nav">
    <ul>
        <li <?= (count($this->pages) == 0) ? "class='active'" : "" ?>><a href="<?= URL ?>"><i class="fa fa-home"></i> <?= SITE_NAME ?></a></li>
    <?php foreach ($this->pages as $p): ?>
        <li <?= (! empty($p["active"])) ? "class='active'" : "" ?>><a href="<?= $p["url"] ?>"><?= $p["name"] ?></a></li>
    <?php endforeach ?>
    </ul>
</nav>