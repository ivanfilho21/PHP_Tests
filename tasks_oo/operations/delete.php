<?php
include "../class/Task.php";
include "../config.php";
include "../database.php";

$task_object = new Task($mysqli);

if (isset($_GET["id"]))
{
    $task_object->deleteTaskFromDB($_GET['id']);
    header("Location: ../index.php");
    die();
}
if (isset($_GET["all"]))
{
    include "../util.php";
    
    $task_object->deleteAllTasksFromDB();
    header("Location: ../index.php");
    die();
}