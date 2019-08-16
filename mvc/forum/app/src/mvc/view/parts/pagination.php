<style>
    .pagination {
        display: block;
        width: fit-content;
        margin: 1rem auto;
        border: 1px solid #aaa;
        border-radius: 8px;
        background-color: white;
        overflow: hidden;
    }

    .pagination ul {
        display: flex;
    }

    .pagination li {
        border-right: 1px solid #aaa;
    }
    .pagination li:last-child {
        border-right: 0;
    }

    .pagination .active {
        background-color: #2089d2;
        color: white;
    }
    .pagination .disabled {
        background-color: whitesmoke;
    }
    .pagination li a {
        display: block;
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
        text-decoration: none;
        color: black;
        transition: background-color 0.2s;
    }
    .pagination li a:hover:not(.active):not(.disabled) {
        background-color: #dadada;
        transition: background-color 0.3s;
    }
</style>


<nav class="pagination">
    <ul>
        <li><a title="Página Anterior"<?= ($page > 1) ? "href='" .($page - 1) ."'" : "class='disabled'" ?>>«</a></li>
    <?php for ($i = 1; $i <= $pages; $i++): ?>
        <li><a title="Ir para a página <?= $i ?>" href="<?= $i ?>" <?= ($page == $i) ? "class='active'" : "" ?>><?= $i ?></a></li>
    <?php endfor ?>
        <li><a title="Próxima Página"<?= ($page < $pages) ? "href='" .($page + 1) ."'" : "class='disabled'" ?>>»</a></li>
    </ul>
</nav>