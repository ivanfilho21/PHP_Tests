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

if (isset($_SESSION["message"]))
{
    $message = $_SESSION["message"];

    if (isset($_SESSION["valid"]))
    {
        $valid = $_SESSION["valid"];
    }

    $_SESSION["message"] = null;

}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (validateCPF())
    {
        #$message = "Seu CPF é válido.";
        $_SESSION["message"] = "Seu CPF é válido.";
        $_SESSION["valid"] = true;
        #$valid = true;
    }
    header("Location: form.php#sec-3");
}

function validateCPF()
{
    $regex = "/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/";
    #echo $regex;

    global $cpf, $message;
    $cpf = $_POST["cpf"];

    if (empty($cpf))
    {
        #$message = "CPF vazio.";
        $_SESSION["message"] = "CPF vazio.";
        $_SESSION["valid"] = false;
        return false;
    }
    if (! preg_match($regex, $cpf))
    {
        #$message = "O número de CPF não segue o padrão.";
        $_SESSION["message"] = "O número de CPF não segue o padrão.";
        $_SESSION["valid"] = false;
        return false;
    }

    return true;
}