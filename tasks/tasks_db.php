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