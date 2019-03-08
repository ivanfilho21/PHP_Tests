<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (validation($dbConnection)) {
        # Checks against SQL Injection
        $name = mysqli_real_escape_string($dbConnection, $_POST["username"]);
        $pass = mysqli_real_escape_string($dbConnection, $_POST["password"]);

        # Checks username and password in database
        if (loginCheck($dbConnection, $name, $pass)) {
            echo "User logged.";
        }
        else {
            echo "Username or password is wrong.";
        }
    }
    else {
        echo "Username or password is wrong.";
    }
} else {
    header("location: index.html");
    exit();
}

function validation($dbConnection)
{
    $res = true;

    if (empty(formatInput($_POST["username"])) || empty(formatInput($_POST["password"]))) {
        $res = false;
    }

    return $res;
}

function formatInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}