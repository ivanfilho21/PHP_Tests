<?php

require "../config.php";
date_default_timezone_set("America/Sao_Paulo");

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

echo json_encode($response);

function validation()
{
    $res = array();
    $all = isset($_GET["all"]) ? true : false;

    foreach ($_GET as $key => $value) {
        if ($all) continue;
        $res[$key] = "";
    }

    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $pass2 = isset($_GET["pass2"]) ? $_GET["pass2"] : "";

    if (! empty($username)) {
        $reg = '/[a-z0-9-]{6,12}/';
        $res["username"] = preg_match($reg, $username) ? 1 : "O nome de usuário deve ter de 6 a 12 caracteres.";
        $res["username"] = ! checkUsername($username) ? "Este nome já está em uso." : $res["username"];
    } else {
        $res["username"] = $all ? 2 : 0;
    }

    if (! empty($email)) {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res["email"] = preg_match($reg, $email) ? 1 : "E-mail inválido.";
    } else {
        $res["email"] = $all ? 2 : 0;
    }

    if (! empty($pass)) {
        $reg = "/[\w]{6,}/";
        $res["pass"] = preg_match($reg, $pass) ? 1 : "A senha deve conter no mínimo 6 caracteres.";
    } else {
        $res["pass"] = $all ? 2 : 0;
    }

    if (! empty($pass2)) {
        $reg = "/[\w]{6,}/";
        $res["pass2"] = preg_match($reg, $pass2) && strcasecmp($pass, $pass2) == 0 ? 1 : "As senhas não coincidem.";
    } else {
        $res["pass2"] = $all ? 2 : 0;
    }

    if ($all) {
        if ($res["username"] == 1 && $res["email"] == 1 && $res["pass"] == 1 && $res["pass2"] == 1) {
            $date = date("Y-m-d H:i:s");

            $user = new User(0, 1, $username, $email, securePassword($pass), $date);
            insertUser($user);

            $res["finished"] = true;
        }
    }

    return $res;
}

function checkUsername($un)
{
    global $dba;
    return $dba->getTable("users")->get("username", $un) != false ? false : true;
}

function insertUser($user)
{
    global $dba;
    $dba->getTable("users")->insert($user);
}