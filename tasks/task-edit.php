<?php
$view_mode = false;

include "util.php";
include "database.php";

$task = getTask($connection, $_GET["id"]);

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
    
    editTask($connection, $task);
    header("Location: tasks_db.php");
    die();
}