<?php

$dbHost = "127.0.0.1";
$dbUser = "ivan";
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

# Creates a table in database
function createTable($conn, $table, $fields)
{
	$values = "";
	foreach ($fields as $f)
	{
		$values .= $f . ", ";
	}
	$values = substr($values, 0, strlen($values) - strlen(", "));
	$sql = "CREATE TABLE {$table} ($values);";


	echo $sql;
	mysqli_query($conn, $sql) or die("<h2>Error creating table {$table}.</h2>");
	echo "<h2>Created table {$table}.</h2>";
}

# Returns a list of data from a database query. If query is false, returns empty list.
function getDataList($res)
{
	$list = array();
	
	if ($res == false) return $list;
	
	while ($data = mysqli_fetch_assoc($res))
	{
		$list[] = $data;
	}
	return $list;
}

# Returns all tables in database.
function getTableList($conn)
{
	$sql = "SHOW TABLES;";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
	
	return getDataList($res);
}

# Returns all columns in a table.
function getTableColumns($conn, $table)
{
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'{$table}';";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
	$list = array();

	return getDataList($res);
}

# Returns all rows in a table.
function getTableContent($conn, $table)
{
	$sql = "SELECT * FROM {$table};";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
	$list = array();

	return getDataList($res);
}