<?php

include PATH ."class/TaskDB.php";

$taskDB = new TaskDB();

$fields = array("ID", "Task Name", "Description", "Created In", "Deadline", "Options");
$tasks = $taskDB->getAll();