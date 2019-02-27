<?php
$valid = false;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (validateCPF())
    {
        $message = "Seu CPF é válido.";
        $valid = true;
    }
}

function validateCPF()
{
    $regex = "/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/";
    #echo $regex;

    global $cpf, $message;
    $cpf = $_POST["cpf"];

    if (empty($cpf))
    {
        $message = "CPF vazio.";
        return false;
    }
    if (! preg_match($regex, $cpf))
    {
        $message = "O número de CPF não segue o padrão.";
        return false;
    }

    return true;
}