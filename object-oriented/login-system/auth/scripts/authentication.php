<?php
$registerFinished = false;
$restrictedPage = "dashboard.php";

# Check if user is already logged.
if ($user != null) {
    $util->redirectToDashboard($relPath);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    # Login
    if (isset($_POST["login"])) {
        $email = $util->formatHTMLInput($_POST["email"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $keepUserLogged = (isset($_POST["keep-logged"])) ? true : false;

        if ($auth->login($email, $password, $keepUserLogged)) {
            $util->redirectToDashboard($relPath);
        } else {
            $util->setErrorMessage("login", $lang->get("err-login", true));
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
                $registerFinished = true;
            }
            else {
                $util->setErrorMessage("register-email", $lang->get("err-email-a", true));
                $res = false;
            }
        }
    }
}

function validateFields()
{
    global $auth, $util, $lang, $email, $username, $password, $passRetype;
    $maxUsername = $auth->getDatabase()->getUserDAO()->getColumnByName("username")->getLength();

    $res = true;

    if (strlen($username) > $maxUsername) {
        $util->setErrorMessage("register-username", $lang->get("err-maxlen", true) ." " .$maxUsername .".");
        $res = false;
    }

    $res = validatePasswords($res, $password, $passRetype);

    return $res;
}

function validatePasswords($res, $password, $passRetype)
{
    global $util, $lang;
    $minPassword = 8;
    
    if (strlen($password) < $minPassword) {
        $util->setErrorMessage("register-pass1", $lang->get("err-pass-a", true));
        $res = false;
    }
    else {
        if ($password !== $passRetype) {
            $util->setErrorMessage("register-pass2", $lang->get("err-pass-b", true));
            $res = false;
        }
    }

    return $res;
}