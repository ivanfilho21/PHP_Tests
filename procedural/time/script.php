<?php

# Constantes de cada período de tempo em segundos.
const ANO = 31536000;
const MES = 2592000;
const DIA = 86400;
const HORA = 3600;
const MINUTO = 60;

# Não esquecer de ajustar a TimeZone
date_default_timezone_set("America/Sao_Paulo");

// Alguma data e hora
$string = "2019-08-13";
$tempo = strtotime($string);

// Data e Hora atual
$agora = time();

// Diferença
$diferenca = $agora - $tempo;

echo "Tempo: " .date("d/m/Y", $tempo);
echo "<br><br>";
echo "Agora: " .date("d/m/Y", $agora);
echo "<br><br>";
echo "diferenca: " .$diferenca;
echo "<br><br>";

$append = "";

if ($diferenca < MINUTO) {
    $append .= " segundo" .(($diferenca == 1) ? "" : "s");
} elseif ($diferenca < HORA) {
    $diferenca = floor($diferenca / MINUTO);
    $append .= " minuto" .(($diferenca == 1) ? "" : "s");
} elseif ($diferenca <= DIA) {
    $diferenca = floor($diferenca / HORA);
    $append .= " hora" .(($diferenca == 1) ? "" : "s");
} elseif ($diferenca < MES) {
    $diferenca = floor($diferenca / DIA);
    $append .= " dia" .(($diferenca == 1) ? "" : "s");
} elseif ($diferenca >= MES && $diferenca < ANO) {
    $diferenca = floor($diferenca / MES);
    $append .= " m" .($diferenca == 1) ? "ê" : "ese" ."s";
} else {
    $diferenca = floor($diferenca / ANO);
    $append .= " ano" .(($diferenca == 1) ? "" : "s");
}

echo "Isso ocorreu há " .$diferenca .$append;
?>