<?php
define("DB", "login_db");
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");

$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB) or die("Error trying to connect to database.");

function loginCheck($conn, $name, $pass) {
    $query = "SELECT id, name FROM users WHERE name = '{$name}' AND pass = MD5('{$pass}')";

    #echo $query; exit();

    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    #echo $rows;

    return ($rows == 0) ? false : true;
}