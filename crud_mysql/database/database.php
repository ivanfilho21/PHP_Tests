<?php

$dbHost = "127.0.0.1";
$dbUser = "tasksys";
$dbPass = "root";
$dbName = "test_db";

$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	
if (mysqli_connect_errno($connection))
{
	echo "Error: There is a problem connecting to the database.";
	die();
}

function get_users($connection)
{	
	$sql = "SELECT * FROM users";
	$res = mysqli_query($connection, $sql);
	$users = array();
	
	if ($res == false) return $users;
	
	while ($u = mysqli_fetch_assoc($res))
	{
		$users[] = $u;
	}
	
	return $users;
}

function save_user($connection, $user)
{
	$fields = array("username", "password");
			
	$values = "";
	$size = count($fields);
	$comma = ", ";
	
	for ($i = 0; $i < $size; $i++)
	{
		$f = $fields[$i];
		
		$values .= "'" . $user[$f] . "'" . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));
	# debugging
	# echo "<h2>Sql: " . $values . "</h2>";
	
	$sql = "
		INSERT INTO users
		(username, password)
		VALUES
		(
		{$values}
		)
	";
	
	# debugging
	# echo $sql;
	
	mysqli_query($connection, $sql) or die();
}
?>