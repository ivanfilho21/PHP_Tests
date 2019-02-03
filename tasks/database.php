<?php

$dbHost = "127.0.0.1";
$dbUser = "tasksys";
$dbPass = "root";
$dbName = "tasks";

$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (mysqli_connect_errno($connection))
{
	echo "Error: There is a problem connecting to the database.";
	die();
}

function save_task($connection, $task)
{
	# Debugging
	/*
	echo "<br>Name: " . $task["name"];
	echo "<br>Created in: " . $task["date_creation"];
	echo "<br>Deadline: " . $task["deadline"];
	echo "<br>Priority: " . $task["priority"];
	echo "<br>Description: " . $task["description"];
	echo "<br>Finished: " . $task["finished"]; */
	
	$sql = "
		INSERT INTO tasks
		(name, date_creation, deadline, priority, description, finished)
		VALUES
		(
			'{$task["name"]}',
			CAST('{$task["date_creation"]}' AS DATE),
			CAST('{$task["deadline"]}' AS DATE),
			{$task["priority"]},
			'{$task["description"]}',
			{$task["finished"]}
		);
	";
	
	echo mysqli_query($connection, $sql) or die(mysql_error());
}