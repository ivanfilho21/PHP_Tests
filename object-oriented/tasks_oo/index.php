<?php
include "class/Task.php";
include "config.php";
include "util.php";
include "database.php";

$view_mode = true;
$task_object = new Task($mysqli);

$validationErrors = array();

# Uncomment this to create database and table
# createDatabase($mysqli);
# createTableTasks($mysqli);
# createTableAttachments($mysqli);

$task = array(
    "id" => (isset($_POST["id"])) ? $_POST["id"] : 0,
    "name" => (isset($_POST["name"])) ? $_POST["name"] : "",
    "date_creation" => (isset($_POST["date_creation"])) ? $_POST["date_creation"] : "",
    "deadline" => (isset($_POST["deadline"])) ? $_POST["deadline"] : "",
    "priority" => (isset($_POST["priority"])) ? $_POST["priority"] : 2,
    "description" => (isset($_POST["description"])) ? $_POST["description"] : "",
    "finished" => (isset($_POST["finished"])) ? "1" : "0"
);

if (postSet())
{
    if (validation($task))
    {
        $task_object->saveTaskInDB($task, $fields);

        header("Location: index.php");
        die();
    }
}

include "template_db.php";

function validation($task)
{
    global $validationErrors;
    $noErrors = true;

    if (empty($task["name"]))
    {
        $noErrors = false;
        $validationErrors["name"] = "You must specify the Task name.";
    }

    return $noErrors;

}

# Get tasks from database and format some of the data to display in Task List.
function getTasksFromDB($task_object)
{
    #global $task_object;
    #$tasks = getTaskList($connection);
    $task_object->getTaskListFromDB();
    $tasks = $task_object->taskList;
    
    foreach ($tasks as $key => $task)
    {
        $tasks[$key] = translateTaskFields($task);
    }
    
    return $tasks;
}