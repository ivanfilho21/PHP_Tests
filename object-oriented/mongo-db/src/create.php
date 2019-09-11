<?php $title = "Novo Sorteio" ?>
<?php require "template-header.php" ?>
<?php require "scripts/create-edit.php" ?>

<style>
    .text-danger {
        color: pink !important;
    }
</style>

<h1>Novo Sorteio</h1>

<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Número do Sorteio:</label>
                <input class="form-control" type="number" name="number" value="<?= $number ?>">
                <span class="text-danger"><?= (! isset($_SESSION["error"]["number"])) ? "" : $_SESSION["error"]["number"] ?></span>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                <label>Data do Sorteio:</label>
                <input class="form-control" type="date" name="date" value="<?= $date ?>">
                <span class="text-danger"><?= (! isset($_SESSION["error"]["date"])) ? "" : $_SESSION["error"]["date"] ?></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Acumulado?</label>
        <br>
        <label><input type="radio" name="ac" value="1" checked> Sim</label>
        <br>
        <label><input type="radio" name="ac" value="0"> Não</label>
    </div>

    <div class="form-group">
        <label>Dezenas Sorteadas:</label>
        <div class="row">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="col-sm">
                <input class="form-control" type="number" name="dezena[]" min="1" max="60" value="<?= (! empty($dezenas[$i])) ? $dezenas[$i] : "1" ?>">
                <br>
            </div>
            <?php endfor ?>
        </div> 
    </div>

    <label class="h3">Sena</label>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Ganhadores:</label>
                <input class="form-control" type="number" name="sena-qty" value="<?= (! empty($senaQty)) ? $senaQty : 0 ?>">
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-sena" placeholder="R$ 999888,00" value="<?= $prizeSena ?>">
                <span class="text-danger"><?= (! isset($_SESSION["error"]["prize"])) ? "" : $_SESSION["error"]["prize"] ?></span>
            </div>
        </div>
    </div>

    <label class="h3">Quina</label>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Ganhadores:</label>
                <input class="form-control" type="number" name="quina-qty" value="<?= (! empty($quinaQty)) ? $quinaQty : 0 ?>">
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-quina" placeholder="R$ 999888,00" value="<?= $prizeQuina ?>">
                <span class="text-danger"><?= (! isset($_SESSION["error"]["prize"])) ? "" : $_SESSION["error"]["prize"] ?></span>
            </div>
        </div>
    </div>

    <label class="h3">Quadra</label>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Ganhadores:</label>
                <input class="form-control" type="number" name="quadra-qty" value="<?= (! empty($quadraQty)) ? $quadraQty : 0 ?>">
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-quadra" placeholder="R$ 999888,00" value="<?= $prizeQuadra ?>">
                <span class="text-danger"><?= (! isset($_SESSION["error"]["prize"])) ? "" : $_SESSION["error"]["prize"] ?></span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col col-md-6 text-center">
            <button class="btn btn-success btn-block" type="submit">Salvar</button>
        </div>
    </div>
</form>

<?php Validation::resetMessages() ?>
<?php require "template-footer.php" ?>