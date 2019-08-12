<h1>Fórum Index</h1>
<h4>Página de Apresentação</h4>

<style>
    table {
        width: 100%;
        border: 1px solid #ccc;
        border-collapse: collapse;
        background-color: whitesmoke;
    }

    tr {
        border-bottom: 1px solid #aaa;
    }

    tr:last-child { border-bottom: none; }

    td {
        padding: 1rem;
    }

    .category {
        display: block;
        padding: 0.5rem;
        border: 1px solid;
        background-color: blue;
        background-image: linear-gradient(to right, #3f51b5, #2196f3);
        color: white;
    }

    .board {
        display: flex;
        align-items: center;
        padding: 1rem;
    }

    .board .status-icon {
        margin-right: 1rem;
    }

    .board a {
        font-weight: bold;
    }
</style>

<?php foreach($categories as $cat): ?>
<table>
    <!-- <tr> -->
        <!-- <td class="category"><?php echo $cat->getName(); ?></td> -->
        <!-- <td> -->
            <!-- <div>                 -->
                <?php foreach($boards as $board): ?>
                <!-- <table> -->
                <?php if ($board->getCategoryId() == $cat->getId()): ?>
                <tr>
                    <td>
                        <div class="status-icon">
                            <a href="#" title="10 tópicos não lidos">
                                <img src="<?php echo URL; ?>assets/img/test.ico" alt="Board Status Icon">
                            </a>
                        </div> 
                    </td>
                    <td>
                        <div class="board">
                            
                            <div>
                                <a href="<?php echo URL; ?>board/<?php echo implode("-", explode(" ", strtolower($board->getName()))); ?>"><?php echo utf8_encode($board->getName()); ?></a>
                                <p><?php echo utf8_encode($board->getDescription()); ?></p>
                                <p>Moderador: <a href="#">TODO</a></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                <!-- </table> -->
                <br>
            <!-- </div> -->
        <!-- </td> -->
    <!-- </tr> -->
</table>
<?php endforeach; ?>

<div>
    <h4>Legenda</h4>
    <img src="<?php echo URL; ?>assets/img/test.ico" alt="Board Icon">
    <span>Tópicos não lidos.</span>
</div>