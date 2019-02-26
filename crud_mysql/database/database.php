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


	#echo $sql;
	mysqli_query($conn, $sql) or die("<h2>Error creating table {$table}.</h2>");
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

#Deletes the specified table.
function dropTable($conn, $name)
{
	$sql = "DROP TABLE {$name};";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
}

#Removes an entry from the specified table.
function deleteFromTable($conn, $table, $field, $value)
{
	$sql = "DELETE FROM {$table} WHERE {$table}.{$field} = '{$value}';";
	#echo $sql;
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
}

function alterTable($conn, $table, $column, $newColumn, $operation, $type)
{
	$sql = "ALTER TABLE {$table} {$operation} COLUMN {$column} {$newColumn} $type;";
	#echo $sql;
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
}

function alterTableName($conn, $tableName, $newName)
{
	$sql = "ALTER TABLE {$tableName} RENAME TO {$newName};";
	#echo $sql;
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
}

# Updates a value in a table
function updateTable($conn, $tableName, $columnName, $newValue, $pkName, $pkValue)
{
	$sql = "UPDATE {$tableName} SET {$columnName} = '{$newValue}' WHERE {$pkName} = '{$pkValue}'";
	#echo $sql;
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
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
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = N'{$table}';";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");

	$list = getDataList($res);
	$columns = array();

	#echo "<br> Debugging Database Table Columns <br>";

	foreach ($list as $key => $value) {
		#echo "<br> " . $key . ": ";
		foreach ($value as $k => $v) {
			#echo $k . " " . $v . ", ";
			$columns[] = $v;
		}
	}

	return $columns;
}

# Returns all rows in a table.
function getTableContent($conn, $table)
{
	$sql = "SELECT * FROM {$table};";
	$res = mysqli_query($conn, $sql) or die("<h2>Error in query: {$sql}</h2>");
	
	return getDataList($res);
}

function getColumnInformation($conn, $table, $column)
{
	# SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'tbl_name' AND COLUMN_NAME = 'col_name';
	# More info at https://dev.mysql.com/doc/refman/8.0/en/columns-table.html

	$sql = "SELECT COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, IS_NULLABLE, EXTRA, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$table}' AND COLUMN_NAME = '{$column}';";

	$res = mysqli_query($conn, $sql);

	$list = getDataList($res);
	$information = array();

	foreach ($list as $key => $value) {
		foreach ($value as $k => $v) {
			#echo $v;
			$information[$k] = $v;
		}
	}

	return $information;
}

# Returns the primary key name, else returns empty list.
function getPrimaryKey($conn, $table)
{
	$sql = "SELECT COLUMN_KEY, COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$table}';";
	$res = mysqli_query($conn, $sql);

	foreach (getDataList($res) as $value) {
		
		if (!empty($value["COLUMN_KEY"]))
			return $value["COLUMN_NAME"];
	}

	return "";
}