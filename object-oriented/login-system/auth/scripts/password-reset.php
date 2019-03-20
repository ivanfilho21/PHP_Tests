<?php
#TODO
$passwordChanged = false;

$index1 = "selector";
$index2 = "validator";

function redirect()
{
    header("Location: " . $relPath . "index.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET[$index1]) && isset($_GET[$index2])) {
        $selector = $_GET[$index1];
        $validator = $_GET[$index2];

        if (ctype_xdigit($selector) === false && ctype_xdigit($validator) === false) {
            redirect();
        }

        # Check if it is a valid token for the user
        if ($auth->getPasswordResetRequest($selector) != null) {
            # TODO
        }



        /*# echo $id; die();
        $user = $auth->getUserById($id);
        if ($user != null) {
            $username = $user->getUsername();
            $user->setUsername(substr($username, 0, strpos($username, " ")));
        }*/
    }
    else {
        redirect();
    }
}
# POST (submit onclick)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new-password"])) {
        $userId = $util->formatHTMLInput($_POST["user-id"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $passRetype = $util->formatHTMLInput($_POST["password-retype"]);

        if (validatePasswords(true, $password, $passRetype)) {
            $auth->changePassword($userId, $password);
            $passwordChanged = true;
        }
        else {
            # header("refresh: 5; url=?{$userid}={$_POST["user-id"]}");
            # header("Location: ?{$userid}={$_POST["user-id"]}");
        }
    }
    else {
        redirect();
    }
}
else {
    redirect();
}