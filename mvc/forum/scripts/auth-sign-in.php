<?php

session_start();
require "../config.php";

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

    $user = login($username, $pass);
    $res["finished"] = ! empty($user);

    if ($res["finished"] && $session == "true") {
        $_SESSION["user-id"] = $user->getId();
    }

    return $res;
}

function login($un, $pass)
{
    global $dba;
    return $dba->getTable("users")->get(array("username" => $un, "password" => securePassword($pass)), null);
}

function securePassword($pass)
{
    return md5($pass);
}