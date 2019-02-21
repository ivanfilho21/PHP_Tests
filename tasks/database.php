<?php

$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPass = "";
$dbName = "tasks";

$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (mysqli_connect_errno($connection))
{
	echo "Error: There is a problem connecting to the database.";
	die();
}

function saveTask($connection, $task)
{	
	global $fields; # fields declared in 'tasks_db.php'
			
	$values = "";
	$size = count($fields);
	$comma = ", ";
	
	for ($i = 0; $i < $size; $i++)
	{
		$f = $fields[$i];
		$qt = "'";
		
		if ($i == 3 || $i == 5) # won't use quotes if field is "priority" or "finished"
			$qt = "";
		
		$values .= $qt . $task[$f] . $qt . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));
	# echo $values;
	
	$sql = "
		INSERT INTO tasks
		(name, date_creation, deadline, priority, description, finished)
		VALUES
		(
			{$values}
		);
	";

	echo $sql;
	
	mysqli_query($connection, $sql) or die("Query Failed. Wrong statement or <strong>table doesn't exist</strong>.");
}

function getTaskList($connection)
{
	$sql = "SELECT * FROM tasks";
	$res = mysqli_query($connection, $sql);
	$tasks = array();

	if ($res == false)
	{
		return $tasks;
	}
	
	while ($t = mysqli_fetch_assoc($res))
	{
		$tasks[] = $t;
	}

	return $tasks;
}

function getTask($connection, $id)
{
	$sql = "SELECT * FROM tasks WHERE id = '{$id}'";
	$res = mysqli_query($connection, $sql);
	if ($res == false)
	{
		echo "<a>Failed getting task</a>";
		return array();
	}
	return mysqli_fetch_assoc($res);
}

function editTask($connection, $task)
{
	global $fields;

	$values = "";
	$comma = ", ";
	foreach ($fields as $field)
	{
		$values .= $field . " = '{$task[$field]}'" . $comma;
	}
	$values = substr($values, 0, strlen($values) - strlen($comma));

	$id = $task["id"];
	$sql = "UPDATE tasks SET {$values} WHERE id = '{$id}'";

	#echo $sql;
	mysqli_query($connection, $sql);
}

function deleteTask($connection, $id)
{
	$sql = "DELETE FROM tasks WHERE id = '{$id}'";
	mysqli_query($connection, $sql);
}