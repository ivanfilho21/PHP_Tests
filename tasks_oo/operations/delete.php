<?php
include "../config.php";
include "../database.php";

if (isset($_GET["id"]))
{
    deleteTask($mysqli, $_GET['id']);
    header("Location: ../index.php");
    die();
}
if (isset($_GET["all"]))
{
    include "../util.php";
    
    deleteAllTasks($mysqli);
    header("Location: ../index.php");
    die();
}