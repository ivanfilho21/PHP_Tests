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
	global $fields; # fields was declared in 'tasks_db.php'
			
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
	
	mysqli_query($connection, $sql) or die("Query Failed.");
}
?>