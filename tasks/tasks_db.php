<?php
$view_mode = true;

include "util.php";
include "database.php";

$validationErrors = array();

# Uncomment this to create database and table
# createDatabase($connection);
# createTableTasks($connection);

$task = array(
	"id" => (isset($_POST["id"])) ? $_POST["id"] : 0,
	"name" => (isset($_POST["name"])) ? $_POST["name"] : "",
	"date_creation" => (isset($_POST["date_creation"])) ? $_POST["date_creation"] : "",
	"deadline" => (isset($_POST["deadline"])) ? $_POST["deadline"] : "",
	"priority" => (isset($_POST["priority"])) ? $_POST["priority"] : 2,
	"description" => (isset($_POST["description"])) ? $_POST["description"] : "",
	"finished" => (isset($_POST["finished"])) ? "1" : "0"
);

if (postSet())
{
	if (validation($task))
	{
		saveTask($connection, $task);
		header("Location: tasks_db.php");
	}
}

include "template_db.php";

# Get tasks from database and format some of the data to display in Task List.
function getTasksFromDB($connection)
{
	$tasks = getTaskList($connection);
	
	for ($i = 0; $i < count($tasks); $i++)
	{
		if ($tasks[$i]["finished"])
			$tasks[$i]["finished"] = "Yes";
		else
			$tasks[$i]["finished"] = "No";
		
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

function validation($task)
{
	global $validationErrors;
	$noErrors = true;

	if (empty($task["name"]))
	{
		$noErrors = false;
		$validationErrors["name"] = "You must specify the Task name.";
	}

	return $noErrors;

}