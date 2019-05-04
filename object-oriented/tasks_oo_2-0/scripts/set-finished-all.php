<?php

include "../config.php";
include "../class/TaskDB.php";

$taskDB = new TaskDB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$ids = array();

	foreach ($_GET as $key => $value) {
		if (strpos($key, "id") !== false) {
			$ids[] = $value;
		}
	}

	foreach ($ids as $id) {
		$task = $taskDB->get($id);
		$task["finished"] = "1";
		unset($task["id"]);
		for ($i = 0; $i < count($task); $i++) {
			unset($task[$i]);
		}
		$taskDB->update($id, $task);
	}
}
header("Location: ../index.php");
die;