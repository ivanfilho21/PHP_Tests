<?php $title = "Novo Sorteio" ?>
<?php require "template-header.php" ?>

<h1>Novo Sorteio</h1>

<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Número do Sorteio:</label>
                <input class="form-control" type="number" name="number" value="0">
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                <label>Data do Sorteio:</label>
                <input class="form-control" type="date" name="date" value="<?= date("Y-m-d") ?>">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Valor do Prêmio:</label>
        <input class="form-control" type="text" name="prize" placeholder="R$ 999.888,00">
    </div>

    <div class="form-group">
        <label>Acumulado?</label>
        <br>
        <label><input type="radio" name="ac" checked> Sim</label>
        <br>
        <label><input type="radio" name="ac"> Não</label>
    </div>

    <div class="row justify-content-center">
        <div class="col col-md-6 text-center">
            <button class="btn btn-success btn-block" type="submit">Salvar</button>
        </div>
    </div>
</form>

<?php require "template-footer.php" ?>