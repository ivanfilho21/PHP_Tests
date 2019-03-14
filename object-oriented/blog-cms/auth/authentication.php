<?php

require ROOT_PATH . "/class/auth/Authentication.php";
require ROOT_PATH . "/Util.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # Authentication object
    $auth = new Authentication($dbAdmin);

    # Login
    if (isset($_POST["login"])) {
        $username = Util::formatHTMLInput($_POST["username"]);
        $password = Util::formatHTMLInput($_POST["password"]);
        # $user = new User(0, $username, $password);

        if ($auth->login($username, $password, false)) {
            header("location: " . $relPath . "index.php");
            die();
        } else {
            # put username in input field
            Util::setErrorMessage("login", "Nome ou Senha incorretos.");
        }
    }

    # Register
    if (isset($_POST["register"])) {
        $username = formatInput($_POST["username"]);
        $password = formatInput($_POST["password"]);

        # todo
    }
}