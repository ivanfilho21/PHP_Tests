<?php

include "class/TaskDB.php";

$taskDB = new TaskDB();

$fields = array("ID", "Task Name", "Description", "Created In", "Deadline", "Attachment", "Options");
$tasks = $taskDB->getAll();