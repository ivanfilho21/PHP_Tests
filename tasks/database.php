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

function createDatabase($connection)
{
	mysqli_query($connection, "CREATE DATABASE tasks") or die("failed creating database");
}

function createTableTasks($connection)
{
	global $fields;
	$types = array("text", "date", "date", "int(1)", "text", "int(1)");
	$values = "id int not null auto_increment primary key, ";
	$comma = ", ";
	$size = count($fields);

	for ($i = 0; $i < $size; $i++)
	{
		$name = $fields[$i];
		$type = $types[$i];

		$values .= $name . " " . $type . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));

	$sql = "CREATE TABLE tasks ({$values})";

	#echo $sql;
	mysqli_query($connection, $sql) or die("failed creating table");
}

function saveTask($connection, $task)
{	
	global $fields; # fields declared in 'tasks_db.php'
			
	$values = "";
	$comma = ", ";
	$qt = "'";
	
	foreach ($fields as $f)
	{		
		$values .= $qt . $task[$f] . $qt . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));
	# echo $values;
	
	$sql = "
		INSERT INTO tasks
		(name, date_creation, deadline, priority, description, finished)
		VALUES ({$values})
	";

	#echo $sql;
	
	mysqli_query($connection, $sql) or die("Query Failed. Wrong statement or <strong>table doesn't exist</strong>.<br><br>SQL Query: " . $sql);
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

function deleteAllTasks($connection)
{
	$sql = "DROP TABLE tasks";
	mysqli_query($connection, $sql);

	createTableTasks($connection);
}