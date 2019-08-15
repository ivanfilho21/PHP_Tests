<style>
    .breadcrumb-nav {
        margin-top: 1rem;
        padding: 0.5rem;
        background-color: whitesmoke;
    }

    .breadcrumb-nav ul {
        display: flex;
        font-size: 0.9rem;
    }
    .breadcrumb-nav li a {
        color: #176093;
    }

    .breadcrumb-nav li.active {
        font-weight: bold;
    }

    .breadcrumb-nav li::after {
        content: "▶";
        position: relative;
        top: -15%;
        font-size: 0.6rem;
        margin: 0.5rem;
    }
    .breadcrumb-nav li:first-child::before {
        content: "";
    }
    .breadcrumb-nav li:last-child::after {
        content: "";
    }
</style>

<nav class="breadcrumb-nav">
    <ul>
    <?php foreach ($this->pages as $p): ?>
        <li <?= (isset($p["active"])) ? "class='active'" : "" ?>><a href="<?= $p["url"] ?>"><?= $p["name"] ?></a></li>
    <?php endforeach ?>
    </ul>
</nav>