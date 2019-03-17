<?php
$registerFinished = false;

# Check if user is already logged.
if ($user != null) {
    header("Location: " . $relPath . "index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    # Login
    if (isset($_POST["login"])) {
        $email = $util->formatHTMLInput($_POST["email"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $keepUserLogged = (isset($_POST["keep-logged"])) ? true : false;

        /*if (empty($email) || empty($password)) {
            $util->setErrorMessage("login", "Nome ou Senha incorretos.");
            return;
        }*/

        if ($auth->login($email, $password, $keepUserLogged)) {
            header("Location: " . $relPath . "index.php");
            die();
        } else {
            $util->setErrorMessage("login", "Nome ou Senha incorretos.");
        }
    }

    # Register
    if (isset($_POST["register"])) {
        $email = $util->formatHTMLInput($_POST["email"]);
        $username = $util->formatHTMLInput($_POST["username"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $passRetype = $util->formatHTMLInput($_POST["password-retype"]);

        if (validateFields()) {
            $user = new User(0, $email, $username, $password);

            if ($auth->register($user)) {
                # TODO: send email with credentials
                # TODO: do not redirect.

                $registerFinished = true;
                header("refresh: 5; url=login.php");

                #header("Location: login.php");
                #die();
            }
            else {
                $util->setErrorMessage("register-email", "Este e-mail já está cadastrado.");
                $res = false;
            }
        }
    }
}

function validateFields()
{
    global $util, $email, $username, $password, $passRetype;

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