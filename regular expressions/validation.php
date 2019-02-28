<?php
$valid = false;
$message = "";
$dark_theme = false;

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    if (isset($_GET["dark-theme"]))
    {
        if (isset($_SESSION["dark-theme"]))
            $_SESSION["dark-theme"] = ! $_SESSION["dark-theme"];
        else
            $_SESSION["dark-theme"] = true;

        header("Location: form.php");
    }
}

if (isset($_SESSION["dark-theme"]))
{
    $dark_theme = $_SESSION["dark-theme"];
}

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