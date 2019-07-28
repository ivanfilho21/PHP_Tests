<?php

require "../config.php";

echo "<pre>" .var_export($_POST, true) ."</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User(0, 1, $_POST["username"], $_POST["name"], $_POST["email"], securePassword($_POST["pass"]));
    $dba->getTable("users")->insert($user);
}

header("location: " .URL ."register");
exit;

function securePassword($pass)
{
    return md5($pass);
}