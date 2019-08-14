<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = true;

    foreach ($_POST as $key => $value) {
        $_SESSION["error-register"][$key] = "";
    }

    $username = format($_POST["username"]);
    $email = format($_POST["email"]);
    $pass = format($_POST["password"]);
    $pass2 = format($_POST["password2"]);

    if (empty($username)) {
        $res = false;
        $_SESSION["error-register"]["username"] = "Escreva o nome de Usuário.";
    } else {
        $reg = "/[a-z0-9-]{6,12}/";
        $res = preg_match($reg, $username);
        if (! $res) $_SESSION["error-register"]["username"] = "O nome de usuário deve ter de 6 a 12 caracteres.";
        if ($this->auth->checkField("username", $username)) $_SESSION["error-register"]["username"] = "O nome de usuário \"<b>" .$username ."\"</b> já está em uso.";
    }

    if (empty($email)) {
        $reg = "/[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/";
        $res = preg_match($reg, $email);
        if (! $res) $_SESSION["error-register"]["email"] = "Digite um E-mail válido.";
    }

    $reg = "/[\w]{6,}/";
    $res = preg_match($reg, $pass);
    if (! $res) $_SESSION["error-register"]["password"] = "A senha deve conter no mínimo 6 caracteres.";

    $res = preg_match($reg, $pass2) && strcasecmp($pass, $pass2) == 0;
    if (! $res) $_SESSION["error-register"]["password2"] = "As senhas devem ser iguais.";

    var_dump($res);

    if ($res) {
        unset($_SESSION["error-register"]);
        $date = \IvanFilho\Date\Date::getCurrentDate();

        $user = new User(0, 1, $username, $email, $this->auth->securePassword($pass), $date);
        $this->auth->insertUser($user);

        # Log user
        $this->auth->login($user);
        redirect("home");
    }

    return $res;
}