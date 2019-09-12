<?php $title = "Sorteio" ?>
<?php require "template-header.php" ?>
<?php require "class/Util.php" ?>
<style>
    .ball {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 50%;
        background: dodgerblue;
        line-height: 3.5rem;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
<?php

$id = isset($_GET["id"]) ? $_GET["id"] : 0;
if (empty($id)) header("Location: index.php");

$ufList = Util::$ufList;
$months = Util::$months;

$docs = $conn->test->megasena->find(array("_id" => DB::getObjectId($id)));
$doc = $docs->toArray()[0];

// echo "<pre>" .print_r($doc, true) ."</pre>";
?>

<h1>Resultado<span class="small"> Concurso <?= $doc["Concurso"] ?></span></h1>

<?php $gan = $doc["Ganhadores_Sena"] + $doc["Ganhadores_Quina"] + $doc["Ganhadores_Quadra"] ?>
<?php $uf = $ufList[$doc["UF"]] ?>
<?php
switch ($uf["g"]) {
    case "m":
        $article = "no";
        break;
    case "f":
        $article = "na";
        break;
    case "n":
        $article = "em";
        break;
    default:
        $article = "";
        break;
}
?>

<?php if ($doc["Acumulado"] == "SIM"): ?>
<h3 style="color: dodgerblue">Acumulou!</h3>
<?php endif ?>

<?php
$date = explode("/", $doc["Data Sorteio"]);

if (is_array($date) && count($date) == 3) {
    $month = substr($date[1], 1, 2);
    $date[1] = lcfirst($months[$month]);
    
    $date = implode(" de ", $date);
} else {
    $date = $date[0];
}
// echo $date;
?>

<p>
    Sorteio realizado <?= ! empty($doc["Cidade"]) ? " em " .$doc["Cidade"] : "" ?> <?= $article ?> <?= $uf["name"] ?> em <?= $date ?>.
</p>

<p>
    Houve ao todo <?= $gan ?> ganhador<?= $gan == 1 ? "" : "es" ?>.
</p>


<?php if (! empty($doc["1ª Dezena"])): ?>
<h4>Dezenas Sorteadas</h4>

<div class="balls d-flex flex-wrap">
    <?php for ($i = 0; isset($doc[($i + 1) ."ª Dezena"]); $i++): ?>
    <div class="ball mr-3 mb-3"><?= $doc[($i + 1) ."ª Dezena"] ." " ?></div>
    <?php endfor ?>
</div>
<?php endif ?>


<h4>Premiação</h4>

<?php $g = $doc["Ganhadores_Sena"] ?>
<h5>Sena <span class="small text-muted">(6 números acertados)</span></h5>

<?php if (empty($g)): ?>
<p>Não houve acertadores.</p>
<?php else: ?>
<ul>
    <li><?= $g ." ganhador" .($g == 1 ? "" : "es") ?></li>
    <li>Valor do Rateio: R$ <?= $doc["Rateio_Sena"] ?></li>
</ul>
<?php endif ?>


<?php $g = $doc["Ganhadores_Quina"] ?>
<h5>Quina <span class="small text-muted">(5 números acertados)</span></h5>
<?php if (empty($g)): ?>
<p>Não houve acertadores.</p>
<?php else: ?>
<ul>
    <li><?= $g ." ganhador" .($g == 1 ? "" : "es") ?></li>
    <li>Valor do Rateio: R$ <?= $doc["Rateio_Quina"] ?></li>
</ul>
<?php endif ?>

<?php $g = $doc["Ganhadores_Quadra"] ?>
<h5>Quadra <span class="small text-muted">(4 números acertados)</span></h5>
<?php if (empty($g)): ?>
<p>Não houve acertadores.</p>
<?php else: ?>
<ul>
    <li><?= $g ." ganhador" .($g == 1 ? "" : "es") ?></li>
    <li>Valor do Rateio: R$ <?= $doc["Rateio_Quadra"] ?></li>
</ul>
<?php endif ?>

<?php require "template-footer.php" ?>