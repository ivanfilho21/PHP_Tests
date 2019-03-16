<?php
$registerMode = false;

# Check if user is already logged.
if ($user != null) {
    header("Location: " . $relPath . "index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["register"])) {
        $registerMode = true;
        $path;
    }
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
            # test
            # echo "<br>Error: " . Util::showError("login");
            # die();
        }
    }

    # Register
    if (isset($_POST["register"])) {

        # Validation of all fields

        if (validateFields()) {
            # todo
        }
        else {
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
            die();
        }
    }
}

function validateFields()
{
    global $util;

    $res = true;
    $username = $util->formatHTMLInput($_POST["username"]);
    $password = $util->formatHTMLInput($_POST["password"]);
    $passRetype = $util->formatHTMLInput($_POST["retype-password"]);

    if (empty($username)) {
        $util->setErrorMessage("register", "Preencha o nome de usuário.");
        $res = false;
    } else {
        if (strlen($username) > 30) {
            $util->setErrorMessage("register", "(" . strlen($username) . ") " . "Nome de usuário deve conter no máximo 30 caracteres.");
            $res = false;
        }
    }

    return $res;
}