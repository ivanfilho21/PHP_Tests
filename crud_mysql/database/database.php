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

# Returns true if the username exists in the database, false otherwise.
function check_username_db($connection, $name)
{
	$sql = "SELECT * FROM users WHERE username = '{$name}';";
	$res = mysqli_query($connection, $sql);
	
	if ( mysqli_fetch_assoc($res) != false) return true;
	return false;
}

# Returns true if the user exists in the database, false otherwise.
function check_login($connection, $name, $pass)
{
	$sql = "SELECT * FROM users WHERE username = '{$name}' AND password = '{$pass}';";
	
	# debugging
	# echo "<br>" . $sql;

	$res = mysqli_query($connection, $sql);
	return mysqli_fetch_assoc($res);
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

function createTable($conn, $table, $fields)
{
	$sql = "CREATE TABLE {$table}";
	echo $sql;
	mysqli_query($conn, $sql) or die("<h2>Error creating table {$table}.</h2>");
}
