<?php

require "../config.php";

global $dba;
$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

echo json_encode($response);

function validation()
{
    $res = array();

    foreach ($_GET as $key => $value) {
        $res[$key] = "";
    }

    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $session = isset($_GET["cb"]) ? $_GET["cb"] : "";

    $user = $dba->getTable("users")->get(array("username" => $username, "password" => securePassword($pass)), null);
    $res["finished"] = ! empty($user);

    if ($res["finished"]) {
        $_SESSION["user-session"]["username"] = $user->getUsername();
        $_SESSION["user-session"]["password"] = $user->getPassword();

        if ($session == "true") {
            # TODO: encrypt userInfo to put in a cookie
            $username = encode($username);
            $pass = encode($pass);

            setrawcookie("user-session", $username . md5(":") . $pass . "", time() + (86400 * 30), "/");
        }
    }

    return $res;
}