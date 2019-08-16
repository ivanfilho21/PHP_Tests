<style>
    .pagination {
        display: flex;
        align-items: center;
        background-color: #333;
        color: white;
    }

    .pagination .caption {
        margin-right: 0.75rem;
    }

    .pagination ul {
        display: inline-flex;
        border: 1px solid #777;
        border-radius: 8px;
        background-color: #666;
        overflow: hidden;
    }

    .pagination li {
        border-right: 1px solid #aaa;
    }
    .pagination li:last-child {
        border-right: 0;
    }

    .pagination .active {
        /*background-color: #2089d2;*/
        /*color: white;*/
        background-color: whitesmoke;
        color: black;
    }
    .pagination .disabled {
        /*background-color: whitesmoke;*/
        background-color: #888;
    }
    .pagination li a {
        display: block;
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
        text-decoration: none;
        /*color: black;*/
        color: white;
        transition: background-color 0.2s;
    }
    .pagination li a:hover:not(.active):not(.disabled) {
        /*background-color: #dadada;*/
        background-color: #888;
        transition: background-color 0.3s;
    }
</style>


<nav class="pagination">
    <div class="container-wider">
        <span class="caption">Página <?= $page ?> de <?= $pages ?></span>

        <ul>
        <?php if ($page > 1): ?>
            <li><a title="Página Anterior"<?= ($page > 1) ? "href='" .$baseUrl .($page - 1) ."'" : "class='disabled'" ?>>«</a></li>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li><a title="Ir para a página <?= $i ?>" href="<?= $baseUrl .$i ?>" <?= ($page == $i) ? "class='active'" : "" ?>><?= $i ?></a></li>
        <?php endfor ?>
        <?php if ($page < $pages): ?>
            <li><a title="Próxima Página"<?= ($page < $pages) ? "href='" .$baseUrl .($page + 1) ."'" : "class='disabled'" ?>>»</a></li>
        <?php endif ?>
        </ul>
    </div>
</nav>