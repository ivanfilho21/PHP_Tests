<?php

include "class/TaskDB.php";

$taskDB = new TaskDB();

$fields = array("ID", "Task Name", "Description", "Priority", "Created In", "Deadline", "Attachments", "Options");
$tasks = $taskDB->getAll();

for ($i = 0; $i < count($tasks); $i++) {
	$tasks[$i]["attachments"] = $taskDB->getAttachments($tasks[$i]["id"]);
}