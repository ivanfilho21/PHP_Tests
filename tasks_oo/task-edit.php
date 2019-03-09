<?php
$view_mode = false;

include "class/Task.php";
include "config.php";
include "util.php";
include "database.php";

$task_object = new Task($mysqli);
$task_object->getTaskFromDB($_GET["id"]);
$task = $task_object->task;
#$task = getTask($connection, $_GET["id"]);

include "template_db.php";

if (isset($_POST["name"]) && $_POST["name"] != "")
{
    $task["id"] = $_GET["id"];
    
    foreach ($fields as $field)
    {
        if (isset($_POST[$field]))
        {
            # echo $_POST[$field] . " ";
            $task[$field] = $_POST[$field];
        }
        else
            $task[$field] = "";
    }
    
    if (isset($task[$fields[5]])) # task finished
    {
        if ($task[$fields[5]] == "")
            $task[$fields[5]] = 0;
        else
            $task[$fields[5]] = 1;
    }
    
    $task_object->editTaskInDB($task, $fields);

    header("Location: index.php");
    die();
}