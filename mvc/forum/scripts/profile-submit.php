<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editUn = (! empty($_SESSION["prof-sub"]["un"])) ? $_SESSION["prof-sub"]["un"] : false;
    $editPs = (! empty($_SESSION["prof-sub"]["ps"])) ? $_SESSION["prof-sub"]["ps"] : false;
    // echo "<pre>" .var_export($_POST, true) ."</pre>";

    if (isset($_POST["submit"])) {
        $username = (empty($editUn)) ? "" : format($_POST["username"]);
        $pass = (empty($editPs)) ? "" : format($_POST["password"]);
        $desc = format($_POST["description"]);
        $sign = $_POST["signature"];

        $res = true;

        if ($editUn) {
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
        }

        if ($editPs) {
            $reg = "/[\w]{6,}/";
            $res = preg_match($reg, $pass);
            if (! $res) $_SESSION["error-msg"]["password"] = "A senha deve conter no mínimo 6 caracteres.";
        }

        if ($res) {
            $now = $this->date->getCurrentDateTime();

            if ($editUn) $user->setUsername($username);
            if ($editPs) $user->setPassword($pass);
            $user->setDescription($desc);
            $user->setSignature($sign);
            $user->setUrl();

            // echo "<pre>" .var_export($user, true) ."</pre>";

            $this->auth->updateUser($user);
            redirect("users/" .$user->getUrl());
        }
    } else {
        if (isset($_POST["edit-username"])) {
            $_SESSION["prof-sub"]["un"] = (! isset($_SESSION["prof-sub"]["un"]));
            $editUn = $_SESSION["prof-sub"]["un"];
            if (! $editUn) unset($_SESSION["prof-sub"]["un"]);
            // $editUn = $_SESSION["prof-sub"]["un"] = true;
        }

        if (isset($_POST["edit-password"])) {
            $_SESSION["prof-sub"]["ps"] = (! isset($_SESSION["prof-sub"]["ps"]));
            $editPs = $_SESSION["prof-sub"]["ps"];
            if (! $editPs) unset($_SESSION["prof-sub"]["ps"]);
            // $editPs = $_SESSION["prof-sub"]["ps"] = true;
        }
    }
} else {
    unset($_SESSION["prof-sub"]);
}