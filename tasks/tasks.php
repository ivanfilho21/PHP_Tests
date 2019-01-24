<?php
session_start();

$fields = array("name", "date_of_creation", "deadline",
			"priority", "description", "finished");
	
if (isset($_GET["name"]) && $_GET["name"] != "")
{
	$task = array();
	
	foreach ($fields as $field)
	{
		if (isset($_GET[$field]))
		{
			$task[$field] = $_GET[$field];
		}
		else
			$task[$field] = "";
	}
	
	# Test
	if (isset($task[$fields[5]])) # task finished
	{
		if ($task[$fields[5]] == "")
			$task[$fields[5]] = "No";
	}
	#
	
	$_SESSION['tasks'][] = $task;
	# array_push($_SESSION['tasks'], $task);
}

include "template.php";