<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = true;

    foreach ($_POST as $key => $value) {
        $_SESSION["error-msg"][$key] = "";
    }

    $username = format($_POST["username"]);
    $email = format($_POST["email"]);
    $pass = format($_POST["password"]);
    $pass2 = format($_POST["password2"]);

    if (empty($username)) {
        $res = false;
        $_SESSION["error-msg"]["username"] = "Escreva o nome de Usuário.";
    } else {
        $reg = "/[a-z0-9-]{6,12}/";
        $res = preg_match($reg, $username);
        if (! $res) $_SESSION["error-msg"]["username"] = "O nome de usuário deve ter de 6 a 12 caracteres.";
        if ($this->auth->checkField("username", $username)) {
            $res = false;
            $_SESSION["error-msg"]["username"] = "O nome de usuário \"<b>" .$username ."\"</b> já está em uso.";
        }
    }

    if (empty($email)) {
        $res = false;
        $_SESSION["error-msg"]["username"] = "Digite um E-mail válido.";
    } else {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res = preg_match($reg, $email);
        if (! $res) $_SESSION["error-msg"]["email"] = "Digite um E-mail válido.";
        if ($this->auth->checkField("email", $email)) $_SESSION["error-msg"]["email"] = "O email \"<b>" .$email ."\"</b> já está em uso.";
    }

    $reg = "/[\w]{6,}/";
    $res = preg_match($reg, $pass);
    if (! $res) $_SESSION["error-msg"]["password"] = "As senhas devem conter no mínimo 6 caracteres.";

    $res = preg_match($reg, $pass2) && strcasecmp($pass, $pass2) == 0;
    if (! $res) $_SESSION["error-msg"]["password2"] = "As senhas devem ser iguais.";

    if ($res) {
        unset($_SESSION["error-msg"]);
        $date = $this->date->getCurrentDateTime();

        $user = new \User(0, \User::TYPE_NORMAL_USER, $username, $email, $this->auth->securePassword($pass), $date);
        $this->auth->insertUser($user);

        # Log user
        $this->auth->login($user);
        redirect("home");
    }

    return $res;
}