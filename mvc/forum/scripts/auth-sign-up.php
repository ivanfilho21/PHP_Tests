<?php

require "../config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

function validation()
{
    $res = array();
    $all = isset($_GET["all"]) ? true : false;

    foreach ($_GET as $key => $value) {
        if ($all) continue;
        $res[$key] = "";
    }
    // $res = array("name" => "", "username" => "", "email" => "", "pass" => "", "pass2" => "");
    $name = isset($_GET["name"]) ? $_GET["name"] : "";
    $username = isset($_GET["username"]) ? $_GET["username"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $pass = isset($_GET["pass"]) ? $_GET["pass"] : "";
    $pass2 = isset($_GET["pass2"]) ? $_GET["pass2"] : "";
    $cb = isset($_GET["cb"]) ? $_GET["cb"] : "";

    $res["name"] = ! empty($name) ? 1 : ($all ? 2 : 0);

    if (! empty($username)) {
        $reg = "/[a-z0-9-]{6,12}/";
        $res["username"] = preg_match($reg, $username) ? 1 : "O nome de usuário deve ter de 6 a 12 caracteres.";
        $res["username"] = ! checkUsername($username) ? "Este nome já está em uso." : $res["username"];
    } else {
        $res["username"] = $all ? 2 : 0;
    }

    if (! empty($email)) {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res["email"] = preg_match($reg, $email) ? 1 : 2;
    } else {
        $res["email"] = $all ? 2 : 0;
    }

    if (! empty($pass)) {
        $reg = "/[\w]{6,}/";
        $res["pass"] = preg_match($reg, $pass) ? 1 : 2;
    } else {
        $res["pass"] = $all ? 2 : 0;
    }

    if (! empty($pass2)) {
        $reg = "/[\w]{6,}/";
        $res["pass2"] = preg_match($reg, $pass2) && strcasecmp($pass, $pass2) == 0 ? 1 : 2;
    } else {
        $res["pass2"] = $all ? 2 : 0;
    }

    if (! empty($cb)) {
        $res["cb"] = $cb == "true" ? 1 : 2;
    } else {
        $res["cb"] = $all ? 2 : 0;
    }

    if ($all && $res["username"] == 1 && $res["name"] == 1 && $res["email"] == 1 && $res["pass"] == 1 && $res["pass2"] == 1) {
        /*$ok = $res["name"] == 1 && $res["username"] == 1 && $res["email"] == 1 && $res["pass"] == 1 && $res["pass2"] == 1 && $res["cb"] == 1;

        $res["valid"] = $ok;*/

        $user = new User(0, 1, $username, $name, $email, securePassword($pass));
        insertUser($user);
        $res["finished"] = true;
    }

    return $res;
}

function checkUsername($un)
{
    global $dba;
    return $dba->getTable("users")->get("nickname", $un) != false ? false : true;
}

function securePassword($pass)
{
    return md5($pass);
}

function insertUser($user)
{
    global $dba;
    // $user = new User(0, 1, $_GET["username"], $_GET["name"], $_GET["email"], securePassword($_GET["pass"]));
    $dba->getTable("users")->insert($user);
}

echo json_encode($response);