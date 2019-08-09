<?php

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

    $reg = '/[a-z0-9-]{6,12}/';
    $res["username"] = preg_match($reg, $username) ? 1 : "O nome de usuário deve ter de 6 a 12 caracteres.";

    $reg = "/[\w]{6,}/";
    $res["pass"] = preg_match($reg, $pass) ? 1 : "A senha deve conter no mínimo 6 caracteres.";

    if ($res["username"] == 1 && $res["pass"] == 1) {
        $res["finished"] = login($username, $pass);
    }

    return $res;
}

function login($un, $pass)
{
    global $dba;
    return $dba->getTable("users")->get(array("username" => $un, "password" => $pass), null) != false;
}

function securePassword($pass)
{
    return md5($pass);
}