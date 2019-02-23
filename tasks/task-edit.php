<?php
$view_mode = false;
$fields = array("name", "date_creation", "deadline", "priority", "description", "finished");

$task = array(
	"id" => 0,
	"name" => "",
	"date_creation" => "",
	"deadline" => "",
	"priority" => 2,
	"description" => "",
	"finished" => ""
);

include "database.php";

$task = getTask($connection, $_GET["id"]);

include "template_db.php";

if (isset($_GET["name"]) && $_GET["name"] != "")
{
	$task["id"] = $_GET["id"];
	
	foreach ($fields as $field)
	{
		if (isset($_GET[$field]))
		{
			# echo $_GET[$field] . " ";
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
	
	editTask($connection, $task);
	header("Location: tasks_db.php");
	die();
}