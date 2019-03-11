<?php

$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPass = "";
$dbName = "crud_mysql_admin";
$usersTable = "users_table";

$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	
if (mysqli_connect_errno($connection))
{
	echo "Error: There is a problem connecting to the database.";
	die();
}

# Returns true if the username exists in the database, false otherwise.
function check_username_db($connection, $name)
{
	global $usersTable;

	$sql = "SELECT * FROM {$usersTable} WHERE username = '{$name}';";
	$res = mysqli_query($connection, $sql);

	if ($res == false) 
	{
		echo "Fatal. '{$usersTable}' table does not exist.";
		return false;
	}
	
	return mysqli_fetch_assoc($res);
}

# Returns true if the user exists in the database, false otherwise.
function check_login($connection, $name, $pass)
{
	global $usersTable;
	$sql = "SELECT * FROM {$usersTable} WHERE username = '{$name}' AND password = '{$pass}';";
	
	$res = mysqli_query($connection, $sql);
	
	if ($res == false) return null;

	return mysqli_fetch_assoc($res);
}

function get_users($connection)
{
	global $usersTable;
	$sql = "SELECT * FROM {$usersTable}";
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
	global $usersTable;

	$fields = array("username", "password");
			
	$values = "";
	$size = count($fields);
	$comma = ", ";
	
	for ($i = 0; $i < $size; $i++)
	#foreach ($fields as $i => $f)
	{
		$f = $fields[$i];
		
		$values .= "'" . $user[$f] . "'" . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));
	
	$sql = "
		INSERT INTO {$usersTable}
		(username, password)
		VALUES
		(
		{$values}
		)
	";
	
	mysqli_query($connection, $sql) or die();
}