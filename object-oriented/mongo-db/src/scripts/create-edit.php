<?php

require "class/Validation.php";

$dbMan = new MongoDB\Driver\Manager();
$bulkWrite = new MongoDB\Driver\BulkWrite;


// $date = (! empty($_POST["date"])) ? ((Validation::validateDate($_POST["date"])) ? $_POST["date"] : date("Y-m-d")) : date("Y-m-d");
// $number = (! empty($_POST["number"])) ? ((Validation::validateInt($_POST["number"])) ? $_POST["number"] : 0) : 0;

$date = ! empty($_POST["date"]) ? $_POST["date"] : "";
$number = ! empty($_POST["number"]) ? Validation::sanitizeInt($_POST["number"]) : 0;
$ac = (! empty($_POST["ac"]) && $_POST["ac"] === "1") ? "SIM" : "NÃO";
$dezenas = (! empty($_POST["dezena"])) ? $_POST["dezena"] : array();
for ($i = 0; $i < count($dezenas); $i++) {
    $dezenas[$i] = Validation::sanitizeInt($dezenas[$i]);
}

$senaQty = (! empty($_POST["sena-qty"])) ? Validation::sanitizeInt($_POST["sena-qty"]) : 1;
$quinaQty = (! empty($_POST["quina-qty"])) ? Validation::sanitizeInt($_POST["quina-qty"]) : 1;
$quadraQty = (! empty($_POST["quadra-qty"])) ? Validation::sanitizeInt($_POST["quadra-qty"]) : 1;

$prizeSena = (! empty($_POST["prize-sena"])) ? Validation::sanitizeMoney($_POST["prize-sena"]) : "";
$prizeQuina = (! empty($_POST["prize-quina"])) ? Validation::sanitizeMoney($_POST["prize-quina"]) : "";
$prizeQuadra = (! empty($_POST["prize-quadra"])) ? Validation::sanitizeMoney($_POST["prize-quadra"]) : "";

echo "<pre>" .var_export($_POST, true) ."</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: continue
    
    if (false && Validation::validate($date, $prize, $number)) {
        $brdate = $date;
        $dateArray = explode("-", $date);
        if (is_array($dateArray) && count($dateArray) == 3) {
            $brdate = $dateArray[2] ."/" .$dateArray[1] ."/" .$dateArray[0];
        }

        $d = array(
            "Concurso" => $number,
            "Estimativa_Prêmio" => $prize,
            "Acumulado" => $ac,
            "Data Sorteio" => $brdate
        );

        // var_dump($d);

        // $bulkWrite->insert($d);
        // $dbMan->executeBulkWrite("test.megasena", $bulkWrite);

        // redirect("index");
    }
}

function redirect(String $url)
{
	$url .= (strpos(".php", $url) === false) ? ".php" : "";
	header("Location: " .$url);
	exit();
}