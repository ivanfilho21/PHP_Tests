<?php
$view_mode = true; #false;
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
include "template_db.php";

if (isset($_GET["name"]) && $_GET["name"] != "")
{
	
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
	
	saveTask($connection, $task);
	#header("Location: tasks.php");
}
	
function get_tasks_from_db($connection)
{
	$tasks = getTaskList($connection);
	
	for ($i = 0; $i < count($tasks); $i++)
	{
		if ($tasks[$i]["finished"] == 0)
			$tasks[$i]["finished"] = "No";
		else
			$tasks[$i]["finished"] = "Yes";
		
		$value = "";
		switch ($tasks[$i]["priority"])
		{
			case 0: $value = "Low"; break; 
			case 1: $value = "Medium"; break; 
			case 2: $value = "High"; break; 
		}
		$tasks[$i]["priority"] = $value;
		
		$dateArray = explode("-", $tasks[$i]["date_creation"]);
		if (count($dateArray) > 1)
			$tasks[$i]["date_creation"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];
		
		$dateArray = explode("-", $tasks[$i]["deadline"]);
		if (count($dateArray) > 1)
			$tasks[$i]["deadline"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];
	}
	
	return $tasks;
}