<?php

require "../config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

echo json_encode($response);

function validation()
{
    global $auth;
    $res = array();
    $res["finished"] = "false";

    foreach ($_GET as $key => $value) {
        $res[$key] = "";
    }

    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $session = isset($_GET["cb"]) ? $_GET["cb"] == "true" : "";

    $user = $auth->getUser(array("username" => $username, "password" => $auth->securePassword($pass)));
    if (! empty($user)) {
        $auth->login($user, $session);
        $res["finished"] = "true";
    }

    return $res;
}