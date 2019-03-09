<?php

include "../class/Task.php";
include "../config.php";
include "../util.php";
include "../database.php";

$task_object = new Task($mysqli);
$task_object->getTaskFromDB($_GET['id']);
$task = $task_object->task;

$task_object->saveTaskInDB($task, $fields);

header("Location: ../index.php");
die();