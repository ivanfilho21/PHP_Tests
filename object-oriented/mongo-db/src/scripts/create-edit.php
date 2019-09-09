<?php

require "class/Validation.php";

$dbMan = new MongoDB\Driver\Manager();
$bulkWrite = new MongoDB\Driver\BulkWrite;

$date = (! empty($_POST["date"])) ? ((Validation::validateDate($_POST["date"])) ? $_POST["date"] : date("Y-m-d")) : date("Y-m-d");
$prize = (! empty($_POST["prize"])) ? $_POST["prize"] : "";
$number = (! empty($_POST["number"])) ? $_POST["number"] : 0;
$ac = (! empty($_POST["ac"]) && $_POST["ac"] === "1") ? "SIM" : "NÃO";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Validation::validate($date, $prize, $number)) {
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
        $bulkWrite->insert($d);
        $dbMan->executeBulkWrite("test.megasena", $bulkWrite);

        redirect("index");
    }
}

function redirect(String $url)
{
	$url .= (strpos(".php", $url) === false) ? ".php" : "";
	header("Location: " .$url);
	exit();
}