<?php
session_start();
include "database.php";

$fields = array("name", "date_creation", "deadline",
			"priority", "description", "finished");
	
if (isset($_GET["name"]) && $_GET["name"] != "")
{
	$task = array();
	
	foreach ($fields as $field)
	{
		if (isset($_GET[$field]))
		{
			echo $_GET[$field] . " ";
			
			$task[$field] = $_GET[$field];
		}
		else
			$task[$field] = "";
	}
	
	# Test
	
	if (isset($task[$fields[5]])) # task finished
	{
		if ($task[$fields[5]] == "")
			$task[$fields[5]] = 0;
		else
			$task[$fields[5]] = 1; # "Yes";
	}
	#
	
	# $_SESSION['tasks'][] = $task;
	save_task($connection, $task);
}

include "template_db.php";