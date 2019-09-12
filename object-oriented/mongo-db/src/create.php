<?php $title = "Novo Sorteio" ?>
<?php require "template-header.php" ?>
<?php require "scripts/create-edit.php" ?>

<style>
    .text-danger {
        color: pink !important;
    }
</style>

<h1>Novo Sorteio</h1>

<form class="mb-5" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Número do Sorteio:</label>
                <input class="form-control" type="number" name="number" min="1" autofocus="on" value="<?= $number ?>">

                <?php if (! empty($error["number"])): ?>
                <span class="text-danger"><?= $error["number"] ?></span>
                <?php endif ?>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                <label>Data do Sorteio:</label>
                <input class="form-control" type="date" name="date" value="<?= $date ?>">

                <?php if (! empty($error["date"])): ?>
                <span class="text-danger"><?= $error["date"] ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Cidade:</label>
                <input class="form-control" type="text" name="city" value="<?= $city ?>">
                <?php if (! empty($error["city"])): ?>
                <span class="text-danger"><?= $error["city"] ?></span>
                <?php endif ?>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                <label>Estado:</label>
                <select class="form-control select" name="uf">
                    <option value="0">-- Selecione</option>
                    <?php foreach (Util::$ufList as $key => $state): ?>
                    <option value="<?= $key ?>" <?= $key == $uf ? "selected" : "" ?>><?= $state["name"] ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (! empty($error["uf"])): ?>
                <span class="text-danger"><?= $error["uf"] ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Acumulado?</label>
        <br>
        <label><input type="radio" name="ac" value="1" <?= $ac == "SIM" ? "checked" : "" ?>> Sim</label>
        <br>
        <label><input type="radio" name="ac" value="0" <?= $ac == "NÃO" ? "checked" : "" ?>> Não</label>
    </div>

    <div class="form-group">
        <label>Dezenas Sorteadas: <span class="small text-muted">(Números entre 1 e 60)</span></label>

        <div class="row">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="col-sm">
                <input class="form-control" type="number" name="dezena[]" min="1" max="60" value="<?= (! empty($dezenas[$i])) ? $dezenas[$i] : "0" ?>">
                
                <?php if (! empty($error["dezena"][$i])): ?>
                <span class="text-danger"><?= $error["dezena"][$i] ?></span>
                <br>
                <?php endif ?>
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
                <input class="form-control" type="number" name="sena-qty" value="<?= $senaQty ?>">

                <?php if (! empty($error["sena-qty"])): ?>
                <span class="text-danger"><?= $error["sena-qty"] ?></span>
                <?php endif ?>
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-sena" placeholder="R$ 999888,00" value="<?= $prizeSena ?>">
                <span class="text-danger"><?= $error["prize"] ?></span>

                <?php if (! empty($error["prize-sena"])): ?>
                <span class="text-danger"><?= $error["prize-sena"] ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>

    <label class="h3">Quina</label>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Ganhadores:</label>
                <input class="form-control" type="number" name="quina-qty" value="<?= (! empty($quinaQty)) ? $quinaQty : 0 ?>">

                <?php if (! empty($error["quina-qty"])): ?>
                <span class="text-danger"><?= $error["quina-qty"] ?></span>
                <?php endif ?>
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-quina" placeholder="R$ 999888,00" value="<?= $prizeQuina ?>">
                <span class="text-danger"><?= $error["prize"] ?></span>

                <?php if (! empty($error["prize-quina"])): ?>
                <span class="text-danger"><?= $error["prize-quina"] ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>

    <label class="h3">Quadra</label>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Ganhadores:</label>
                <input class="form-control" type="number" name="quadra-qty" value="<?= (! empty($quadraQty)) ? $quadraQty : 0 ?>">

                <?php if (! empty($error["quadra-qty"])): ?>
                <span class="text-danger"><?= (! isset($error["quadra-qty"])) ? "" : $error["quadra-qty"] ?></span>
                <?php endif ?>
            </div>

        </div>
        <div class="col-md">
            <div class="form-group">
                <label>Valor do Prêmio:</label>
                <input class="form-control" type="text" name="prize-quadra" placeholder="R$ 999888,00" value="<?= $prizeQuadra ?>">
                <span class="text-danger"><?= (! isset($error["prize"])) ? "" : $error["prize"] ?></span>

                <?php if (! empty($error["prize-quadra"])): ?>
                <span class="text-danger"><?= (! isset($error["prize-quadra"])) ? "" : $error["prize-quadra"] ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col col-md-6 text-center">
            <button class="btn btn-success btn-block" type="submit">Salvar</button>
        </div>
    </div>
</form>

<?php Validation::resetMessages() ?>
<?php require "template-footer.php" ?>