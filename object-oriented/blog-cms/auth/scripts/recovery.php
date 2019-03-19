<?php

$user = null;
$passwordChanged = false;

#echo "" . md5("userid"); die();
$userid = "ea8f538c94b6e352418254ed6474a81f";

if (isset($_GET[$userid])) {
    $id = $_GET[$userid];
    # echo $id; die();
    $user = $auth->getUserById($id);
    if ($user != null) {
        $username = $user->getUsername();
        $user->setUsername(substr($username, 0, strpos($username, " ")));
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new-password"])) {
        $userId = $util->formatHTMLInput($_POST["user-id"]);
        $password = $util->formatHTMLInput($_POST["password"]);
        $passRetype = $util->formatHTMLInput($_POST["password-retype"]);

        if (validatePasswords(true, $password, $passRetype)) {
            $auth->changePassword($userId, $password);
            $passwordChanged = true;
        }
        else {
            #header("refresh: 5; url=?{$userid}={$_POST["user-id"]}");
            #header("Location: ?{$userid}={$_POST["user-id"]}");
        }
    }
}