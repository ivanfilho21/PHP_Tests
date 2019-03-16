<?php

# Check if user is already logged.
if ($user != null) {
    header("Location: " . $relPath . "index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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