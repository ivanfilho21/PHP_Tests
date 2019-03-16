<?php

# Check if user is already logged.
if ($user != null) {
    header("Location: " . $relPath . "index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    # Login
    if (isset($_POST["login"])) {
        $username = $util->formatHTMLInput($_POST["username"]);
        $password = $util->formatHTMLInput($_POST["password"]);

        if (empty($username) || empty($password)) {
            $util->setErrorMessage("login", "Nome ou Senha incorretos.");
            return;
        }

        if ($auth->login($username, $password, false)) {
            header("Location: " . $relPath . "index.php");
            die();
        } else {
            $util->setErrorMessage("login", "Nome ou Senha incorretos.");
        }
    }

    # Register
    if (isset($_POST["register"])) {
        $username = $util->formatHTMLInput($_POST["username"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $passRetype = $util->formatHTMLInput($_POST["password-retype"]);

        if (validateFields()) {
            if ($auth->register($username, $password)) {
                header("Location: login.php");
                die();
            }
            else {
                $util->setErrorMessage("register-username", "Este nome de usuário já existe.");
                $res = false;
            }
        }
    }
}

function validateFields()
{
    global $util, $username, $password, $passRetype;

    $res = true;

    /*if (empty($username)) {
        $util->setErrorMessage("register", "Preencha o nome de usuário.");
        $res = false;
    } else {
    }*/
    if (strlen($username) > 30) {
        $util->setErrorMessage("register-username", "(" . strlen($username) . ") " . "Nome de usuário deve conter no máximo 30 caracteres.");
        $res = false;
    }

    if (strlen($password) < 8) {
        $util->setErrorMessage("register-pass1", "A senha deve conter no mínimo 8 caracteres.");
        $res = false;
    }
    else if (strlen($password) > 32) {
        $util->setErrorMessage("register-pass1", "A senha deve conter no máximo 32 caracteres.");
        $res = false;
    }
    else {
        if ($password === $passRetype) {
            #
        }
        else {
            $util->setErrorMessage("register-pass2", "As senhas digitadas não são iguais.");
            $res = false;
        }
    }

    return $res;
}