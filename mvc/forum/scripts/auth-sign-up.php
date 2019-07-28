<?php

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

function validation()
{
    $res = array();

    foreach ($_GET as $key => $value) {
        $res[$key] = "";
    }
    // $res = array("name" => "", "username" => "", "email" => "", "pass" => "", "pass2" => "");
    $name = isset($_GET["name"]) ? $_GET["name"] : "";
    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $pass2 = isset($_GET["pass2"]) ? $_GET["pass2"] : "";

    $res["name"] = ! empty($name) ? 1 : 0;

    if (! empty($username)) {
        $reg = "/[a-z0-9-]{6,}/";
        $res["username"] = preg_match($reg, $username) ? 1 : 2;
    } else {
        $res["username"] = 0;
    }

    if (! empty($email)) {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res["email"] = preg_match($reg, $email) ? 1 : 2;
    } else {
        $res["email"] = 0;
    }

    if (! empty($pass)) {
        $reg = "/[\w]{6,}/";
        $res["pass"] = preg_match($reg, $pass) ? 1 : 2;
    } else {
        $res["pass"] = 0;
    }

    if (! empty($pass2)) {
        $reg = "/[\w]{6,}/";
        $res["pass2"] = preg_match($reg, $pass2) && strcasecmp($pass, $pass2) == 0 ? 1 : 2;
    } else {
        $res["pass2"] = 0;
    }

    return $res;
}

echo json_encode($response);