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

        if (empty($username) || empty($password)) {
            Util::setErrorMessage("login", "Nome ou Senha incorretos.");
            return;
        }

        if ($auth->login($username, $password, false)) {
            header("Location: " . $relPath . "index.php");
            die();
        } else {
            Util::setErrorMessage("login", "Nome ou Senha incorretos.");
            # test
            # echo "<br>Error: " . Util::showError("login");
            # die();
        }
    }

    # Register
    if (isset($_POST["register"])) {
        $username = formatInput($_POST["username"]);
        $password = formatInput($_POST["password"]);

        # todo
    }
}