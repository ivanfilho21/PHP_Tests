<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = true;

    $username = format($_POST["username"]);
    $pass = format($_POST["password"]);
    $session = isset($_POST["session"]) && $_POST["session"] == "on";

    if (empty($username) || empty($pass)) {
        $res = false;
    }

    if ($res) {
        $user = $this->auth->getUser(array("username" => $username, "password" => $this->auth->securePassword($pass)));

        if (empty($user)) {
            $_SESSION["error-msg"] = "Usuário ou Senha incorretos.";
        } else {
            unset($_SESSION["error-msg"]);
            $this->auth->login($user, $session);
            redirect("home");
        }
    } else {
        $_SESSION["error-msg"] = "Usuário ou Senha incorretos.";
    }

    return $res;
}