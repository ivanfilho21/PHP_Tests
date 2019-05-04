<?php

include "../config.php";
include "../class/TaskDB.php";

$taskDB = new TaskDB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $taskDB->delete($id);
}
header("Location: ../index.php");
die;