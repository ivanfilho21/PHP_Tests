<?php

$dbMan = new MongoDB\Driver\Manager();
$bulkWrite = new MongoDB\Driver\BulkWrite;

# Init variables
$date = ! empty($_POST["date"]) ? $_POST["date"] : date("Y-m-d");
$number = ! empty($_POST["number"]) ? $_POST["number"] : 0;
$ac = ! empty($_POST["ac"]) && $_POST["ac"] === "1" ? "SIM" : "NÃO";
$dezenas = ! empty($_POST["dezena"]) ? $_POST["dezena"] : array();
for ($i = 0; $i < count($dezenas); $i++) {
    $dezenas[$i] = $dezenas[$i];
}

$senaQty = ! empty($_POST["sena-qty"]) ? $_POST["sena-qty"] : 0;
$quinaQty = ! empty($_POST["quina-qty"]) ? $_POST["quina-qty"] : 0;
$quadraQty = ! empty($_POST["quadra-qty"]) ? $_POST["quadra-qty"] : 0;

$prizeSena = ! empty($_POST["prize-sena"]) ? $_POST["prize-sena"] : "";
$prizeQuina = ! empty($_POST["prize-quina"]) ? $_POST["prize-quina"] : "";
$prizeQuadra = ! empty($_POST["prize-quadra"]) ? $_POST["prize-quadra"] : "";

// echo "<pre>" .var_export($_POST, true) ."</pre>";

$error = array();

if ($_SERVER["REQUEST_METHOD"] == "POST"/*  && ! empty($_POST["submit"]) */) {
    # String Sanitization
    filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    // echo "<pre>" .var_export($error, true) ."</pre>";

    if (validation()) {
        $prizeSena = str_replace(",", ".", $prizeSena);
        $prizeQuina = str_replace(",", ".", $prizeQuina);
        $prizeQuadra = str_replace(",", ".", $prizeQuadra);

        $prizeSena = number_format($prizeSena, 2, ',', '.');
        $prizeQuina = number_format($prizeQuina, 2, ',', '.');
        $prizeQuadra = number_format($prizeQuadra, 2, ',', '.');
        
        $d = array(
            "Concurso" => $number,
            "Data Sorteio" => convertToBrazilianDateFormat($date),
            "Acumulado" => $ac,
            "Ganhadores_Sena" => $senaQty,
            "Ganhadores_Quina" => $quinaQty,
            "Ganhadores_Quadra" => $quadraQty,
            "Rateio_Sena" => ! empty($senaQty) ? $prizeSena : 0,
            "Rateio_Quina" => ! empty($quinaQty) ? $prizeQuina : 0,
            "Rateio_Quadra" => ! empty($quadraQty) ? $prizeQuadra : 0,
        );

        for ($i = 0; $i < count($dezenas); $i++) {
            $d[($i + 1) ."ª Dezena"] = $dezenas[$i];
        }

        // echo "<pre>" .var_export($d, true) ."</pre>";
        
        $bulkWrite->insert($d);
        $dbMan->executeBulkWrite("test.megasena", $bulkWrite);
        
        redirect("index");
    }
}

function validation()
{
    global $number, $date, $dezenas, $senaQty, $quinaQty, $quadraQty, $prizeSena, $prizeQuina, $prizeQuadra;
    global $conn, $error;
    $res = true;

    # Check if the number has a acceptable format
    $number = filter_var($number, FILTER_VALIDATE_INT);

    if (empty($number)) {
        $res = false;
        $error["number"] = "Digite um número maior que zero.";
    } else {
        if ($number < 0) {
            $res = false;
            $error["number"] = "Valor inválido.";
        } else {
            # Check if draw number is already being used
            $cd = $conn->test->megasena->find(array("Concurso" => intval($number)));   
            $doc = $cd->toArray();
            if (! empty($doc)) {
                $res = false;
                $error["number"] = "Já existe um sorteio com esse número.";
            }
        }
    }

    # Date
    if (empty($date)) {
        $res = false;
        $error["date"] = "Digite uma data válida.";
    } else {
        $regex = "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/";
        if (! preg_match($regex, $date)) {
            $res = false;
            $error["date"] = "Formato de data inválida.";
        }
    }

    # Validating dezenas
    foreach ($dezenas as $k => $v) {
        if (empty($v)) {
            $res = false;
            $error["dezena"][$k] = "Valor inválido.";
        } else {
            $dezenas[$k] = filter_var($v, FILTER_VALIDATE_INT);
            if ($dezenas[$k] <= 0) {
                $res = false;
                $error["dezena"][$k] = "Valor inválido.";
            }
        }
    }

    # Check if prizes are in the correct format
    $senaQty = filter_var($senaQty, FILTER_VALIDATE_INT);
    $quinaQty = filter_var($quinaQty, FILTER_VALIDATE_INT);
    $quadraQty = filter_var($quadraQty, FILTER_VALIDATE_INT);

    if ($senaQty < 0) {
        $res = false;
        $error["sena-qty"] = "Valor inválido.";
    }
    if ($quinaQty < 0) {
        $res = false;
        $error["quina-qty"] = "Valor inválido.";
    }
    if ($quadraQty < 0) {
        $res = false;
        $error["quadra-qty"] = "Valor inválido.";
    }

    # Check if prizes have dots
    if (strpos($prizeSena, ".") !== false) {
        $res = false;
        $error["prize-sena"] = "Valor inválido.";
    }
    if (strpos($prizeQuina, ".") !== false) {
        $res = false;
        $error["prize-quina"] = "Valor inválido.";
    }
    if (strpos($prizeQuadra, ".") !== false) {
        $res = false;
        $error["prize-quadra"] = "Valor inválido.";
    }

    return $res;
}

function convertToBrazilianDateFormat(String $date)
{
    $brdate = $date;
    $dateArray = explode("-", $date);
    if (is_array($dateArray) && count($dateArray) == 3) {
        $brdate = $dateArray[2] ."/" .$dateArray[1] ."/" .$dateArray[0];
    }
    return $brdate;
}

function redirect(String $url)
{
	$url .= (strpos(".php", $url) === false) ? ".php" : "";
	header("Location: " .$url);
	exit();
}