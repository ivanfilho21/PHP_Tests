<?php

include "../config.php";
include "../class/TaskDB.php";

$taskDB = new TaskDB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$id = $_GET["id"];
	$task = $taskDB->get($id);
	unset($task["id"]);

	for ($i=0; $i < count($task); $i++) { 
		unset($task[$i]);
	}
	$taskDB->insert($task);
}
header("Location: ../index.php");
die;