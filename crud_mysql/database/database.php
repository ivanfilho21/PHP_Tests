<?php

$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPass = "";
$dbName = "crud_mysql";

$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	
if (mysqli_connect_errno($connection))
{
	echo "Error: There is a problem connecting to the database.";
	die();
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

#Inserts data into a table
function insertIntoTable($conn, $table, $columns, $data)
{
	$fields = "";
	$comma = ", ";

	foreach ($columns as $i => $columnName) {
		$fields .= $columnName . $comma;
	}
	$fields = substr($fields, 0, strlen($fields) - strlen($comma));

	$values = "";
	
	foreach ($data as $d)
	{
		$values .= "'" . $d . "'" . $comma;
	}

	$values = substr($values, 0, strlen($values) - strlen($comma));
	
	$sql = "
		INSERT INTO {$table}
		(
		{$fields}
		)
		VALUES
		(
		{$values}
		);
	";

	echo "<br>" . $sql;
	
	mysqli_query($conn, $sql) or die();
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

#Deletes the specified table.
function dropTable($conn, $name)
{
	$sql = "DROP TABLE {$name};";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
}