<?php
$passwordChanged = false;
$requestExpired = false;

$index1 = "selector";
$index2 = "validator";

function redirect()
{
    $util->redirectTo($relPath, "./");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET[$index1]) && isset($_GET[$index2])) {
        $selector = $_GET[$index1];
        $validator = $_GET[$index2];

        # Checks if selector and token are valid hexadecimals
        if (ctype_xdigit($selector) === false && ctype_xdigit($validator) === false) {
            redirect();
        }

        # Checks if it is a valid token for the user and if it's not expired yet
        $requestExpired = ! $auth->checkValidPasswordResetRequest($selector);
    }
    else {
        redirect();
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new-password"])) {
        $selector = $util->formatHTMLInput($_POST["selector"]);
        $request = $auth->getPasswordResetRequest($selector);

        if ($request == null) {
            ?>
            <b><?php $lang->get("expired-request"); ?></b>.
            <br>
            <?php $lang->get("you-are-redirected-to"); ?>
            <?php $lang->get("login-page"); ?>...
            <?php
            header("refresh: 5; url=login.php");
        }
        else {
            $userEmail = $request->getEmail();
            $password = $util->formatHTMLInput($_POST["password"]);
            $passRetype = $util->formatHTMLInput($_POST["password-retype"]);

            if (validatePasswords(true, $password, $passRetype)) {
                $auth->changePassword($userEmail, $password);
                $passwordChanged = true;
                $auth->deletePasswordResetRequest($userEmail);
            }
        }
    }
    else {
        redirect();
    }
}
else {
    redirect();
}