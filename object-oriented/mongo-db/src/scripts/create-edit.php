<?php

require "class/Util.php";

$dbMan = new MongoDB\Driver\Manager();
$bulkWrite = new MongoDB\Driver\BulkWrite;

$doc = array();

$id = empty($_GET["id"]) ? 0 : $_GET["id"];
if (! empty($id)) {
    $cd = $conn->test->megasena->find(array("_id" => DB::getObjectId($id)));
    $doc = $cd->toArray();
    $doc = $doc[0];
    if (empty($doc)) redirect("index");

    echo "<pre>" .var_export($doc, true) ."</pre>";
}

# Init variables
$number = ! empty($_POST["number"]) ? $_POST["number"] : (! empty($doc["Concurso"]) ? $doc["Concurso"] : 0);
$date = ! empty($_POST["date"]) ? $_POST["date"] : (! empty($doc["Data_Sorteio"]) ? $doc["Data_Sorteio"] : date("Y-m-d"));
$city = ! empty($_POST["city"]) ? $_POST["city"] : (! empty($doc["Cidade"]) ? $doc["Cidade"] : "");
$uf = ! empty($_POST["uf"]) ? $_POST["uf"] : (! empty($doc["UF"]) ? $doc["UF"] : "");
$ac = ! empty($_POST["ac"]) && $_POST["ac"] === "1" ? "SIM" : (! empty($doc["Acumulado"]) ? $doc["Acumulado"] : "NÃO");
$dezenas = ! empty($_POST["dezena"]) ? $_POST["dezena"] : array();

if (! empty($doc["1ª Dezena"])) {
    for ($i = 0; $i < 6; $i++) {
        $dezenas[$i] = (empty($doc[($i + 1) ."ª Dezena"])) ? 0 : $doc[($i + 1) ."ª Dezena"];
    }
}

$senaQty = ! empty($_POST["sena-qty"]) ? $_POST["sena-qty"] : (! empty($doc["Ganhadores_Sena"]) ? $doc["Ganhadores_Sena"] : 0);
$quinaQty = ! empty($_POST["quina-qty"]) ? $_POST["quina-qty"] : (! empty($doc["Ganhadores_Quina"]) ? $doc["Ganhadores_Quina"] : 0);
$quadraQty = ! empty($_POST["quadra-qty"]) ? $_POST["quadra-qty"] : (! empty($doc["Ganhadores_Quadra"]) ? $doc["Ganhadores_Quadra"] : 0);

$prizeSena = ! empty($_POST["prize-sena"]) ? $_POST["prize-sena"] : (! empty($doc["Rateio_Sena"]) ? $doc["Rateio_Sena"] : "");
$prizeQuina = ! empty($_POST["prize-quina"]) ? $_POST["prize-quina"] : (! empty($doc["Rateio_Quina"]) ? $doc["Rateio_Quina"] : "");
$prizeQuadra = ! empty($_POST["prize-quadra"]) ? $_POST["prize-quadra"] : (! empty($doc["Rateio_Quadra"]) ? $doc["Rateio_Quadra"] : "");

// echo "<pre>" .var_export($_POST, true) ."</pre>";

$error = array();

if ($_SERVER["REQUEST_METHOD"] == "POST"/*  && ! empty($_POST["submit"]) */) {
    # String Sanitization
    filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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
            "Cidade" => $city,
            "UF" => $uf,
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

        echo "<pre>" .var_export($d, true) ."</pre>";

        
        if (empty($doc)) {
            # INSERT
            $bulkWrite->insert($d);
            $dbMan->executeBulkWrite("test.megasena", $bulkWrite);
        } else {
            # EDIT
            $bulkWrite->update(array("_id" => DB::getObjectId($doc["_id"])), $d);
            $dbMan->executeBulkWrite("test.megasena", $bulkWrite);
        }
        redirect("index");
    }
}

function validation()
{
    global $number, $date, $city, $uf, $dezenas, $senaQty, $quinaQty, $quadraQty, $prizeSena, $prizeQuina, $prizeQuadra;
    global $conn, $error, $doc;
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

            if ($doc["Concurso"] != $number) {
                $db = $conn->test->megasena->find(array("Concurso" => intval($number)));   
                $sorteio = $db->toArray();
                if (! empty($sorteio)) {
                    $res = false;
                    $error["number"] = "Já existe um sorteio com esse número.";
                }
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

    # Validating City and UF
    if (empty($uf)) {
        $res = false;
        $error["uf"] = "Selecione o estado onde ocorreu o sorteio.";
    } else {
        # Check if it is a valid UF
        $resLocal = false;
        foreach (Util::$ufList as $key => $state) {
            if ($uf == $key) {
                $resLocal = true;
                break;
            }
        }

        if (! $resLocal) {
            $res = false;
            $error["uf"] = "Selecione um estado válido.";
        }
    }

    if (empty($city)) {
        $res = false;
        $error["city"] = "Especifique a cidade onde ocorreu o sorteio.";
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

    if ($senaQty > 0 && $prizeSena <= 0) {
        $res = false;
        $error["prize-sena"] = "Especifique o valor do prêmio.";
    }

    if ($quinaQty > 0 && $prizeQuina <= 0) {
        $res = false;
        $error["prize-quina"] = "Especifique o valor do prêmio.";
    }

    if ($quadraQty > 0 && $prizeQuadra <= 0) {
        $res = false;
        $error["prize-quadra"] = "Especifique o valor do prêmio.";
    }

    // echo "<pre>" .var_export($error, true) ."</pre>";

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