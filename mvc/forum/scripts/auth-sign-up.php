<?php

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
    // $response = "Get is ok";
}

function validation()
{
    $res = 0;
    $name = isset($_GET["name"]) ? $_GET["name"] : "";
    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $pass2 = isset($_GET["pass2"]) ? $_GET["pass2"] : "";

    if (! empty($name)) {
        $res = 1;
    }

    if (! empty($username)) {
        $reg = "/[a-z0-9-]{6,}/";
        $res = preg_match($reg, $username) ? 1 : 2;
    }

    if (! empty($email)) {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res = preg_match($reg, $email) ? 1 : 2;
    }

    if (! empty($pass)) {
        $reg = "/[\w]{6,}/";
        $res = preg_match($reg, $pass) ? 1 : 2;
    }

    if (! empty($pass2)) {
        $reg = "/[\w]{6,}/";
        $res = preg_match($reg, $pass2) && $pass == $pass2  ? 1 : 2;
    }

    return $res;
}

echo $response;