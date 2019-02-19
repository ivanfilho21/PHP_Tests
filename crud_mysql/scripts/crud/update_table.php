<?php

$columnTypes = array("int", "varchar", "real", "text", "date");
$totalOfColumns = 0;
$columns = array();
$columnInfo = array();
$COL = array();
$tableName = "";

if (isset($_GET["table"]))
{
	foreach ($_GET["table"] as $key => $value) {
		$tableName = $key;
		break;
	}
	echo "<h1>Table {$tableName}</h1>";
}

# Initialize
init();

# Rename table
if (isset($_POST["alter-name"]))
{
	$array = $_POST["alter-name"];
	$tableName = key($array);

	$newName = "";
	if (validateTableName())
	{
		alterTableName($connection, $tableName, $newName);
		header("Location:update-table.php?table[{$newName}]");
	}
}

# Remove or Modify Column
if (isset($_POST["alter"]))
{
	$columnName = "";
	$columnNewName = "";
	$operation = "";
	$type = "";

	if (validateColumns())
	{
		alterTable($connection, $tableName, $columnName, $columnNewName, $operation, $type);
		header("Location:update-table.php?table[{$tableName}]");
	}
	else
	{
		echo "failed alter";
		init();
	}
}

function init()
{
	global $COL, $columns, $columnInfo, $columnTypes, $tableName, $connection, $totalOfColumns;

	if (isset($tableName))
	{
		$columns = getTableColumns($connection, $tableName);
	}

	$totalOfColumns = count($columns);

	foreach ($columns as $key => $column) {
		$columnInfo[$key] = getColumnInformation($connection, $tableName, $column);
	}

	/*
	$ac = 1;
	foreach ($columnInfo as $key => $value) {
		echo "<br> Col {$ac}: ";
		foreach ($value as $k => $v) {
			echo $k . ": " . $v . ", ";
		}
		$ac++;
	} */

	foreach ($columns as $key => $column)
	{
		$COL[$key]["name"] = $columnInfo[$key]["COLUMN_NAME"];

		$v = $columnInfo[$key]["COLUMN_TYPE"];
		#echo "<br>column type: " .$v.".";
		$pos = strpos($v, "(");

		if ($pos == false)
		{
			$type = $v;
			$len = 0;
		}
		else
		{
			$type = substr($v, 0, $pos);
			$len = substr($v, $pos + 1);
			$len = substr($len, 0, strlen($len) - 1);
			#echo "<br>My type: " . $type . ". My length: " . $len;
		}

		$COL[$key]["type"] = $type;

		if ($len > 0)
		{
			if ($len == 11 && $type == $columnTypes[0])
			{
				# Do nothing :D
			}
			else
				$COL[$key]["length"] = $len;
		}

		if (isset($columnInfo[$key]["IS_NULLABLE"]))
			if ($columnInfo[$key]["IS_NULLABLE"] == "NO")
				$COL[$key]["null"] = "no";

		if (isset($columnInfo[$key]["EXTRA"]))
			if ($columnInfo[$key]["EXTRA"] == "auto_increment")
				$COL[$key]["auto"] = "yes";

		if (isset($columnInfo[$key]["COLUMN_KEY"]))
			if ($columnInfo[$key]["COLUMN_KEY"] == "PRI")
				$COL[$key]["pk"] = "yes";
	}
}

# Validations

function validateTableName()
{
	global $newName, $error_msgs;
	$res = true;

	if (isset($_POST["table_name"]))
	{
		$newName = format_input($_POST["table_name"]);
		# echo "New name: " . $newName;

		if (empty($newName))
		{
			$error_msgs["table_name"] = "Table name can't be empty.";
			$res = false;
		}
	}
	
	return $res;
}

function validateColumns()
{
	global $error_msgs, $tableName, $columnName, $columnNewName, $operation, $type, $COL;
	$res = true;

	$array = $_POST["alter"];
	$tableName = key($array);

	$array = $array[$tableName];
	$operation = key($array);

	$array = $array[$operation];
	$columnName = key($array);

	if ($operation == "modify")
	{
		echo "<br>...<br>";

		
		$array = $array[$columnName];
		$i = key($array);

		$col = $_POST["column".$i];

		# check if column name will change
		if ($columnName != $col["name"])
		{
			if (empty($col["name"]))
			{
				$res = false;
				$error_msgs[$i]["name"] = "Can't be empty.";
			}
			$operation = "CHANGE";
			$columnNewName = $col["name"];
		}

		# get type and length
		if (isset($col["type"]))
		{
			$type = $col["type"];
			#echo "<br>set type: " . $type;
		}
		else
		{
			$array = $array[$i];
			$type = key($array);
			#echo "<br>NOT set type: " . $type;
		}

		if (isset($col["length"]))
		{
			###
			$colLength = format_input($col["length"]);
			if (is_numeric($colLength))
			{
			    if ((int)$colLength > 0)
			    	$type .= "(" . $colLength . ")";
			    else if ((int)$colLength == 0)
			    {
					$type .= "";
			    }
			    else
			    {
			    	$res = false;
			    	$error_msgs[$i]["length"] = "Negative number.";
			    }
			}
			else if (empty($colLength))
			{
				if ($type == "varchar")
				{
					$res = false;
					$error_msgs[$i]["length"] = "Must specify.";
				}
				else
					$type .= "";
			}
			else
			{
				$res = false;
			    $error_msgs[$i]["length"] = "Invalid number.";
			}

			#$type .= "(" . $col["length"] . ")";
		}
	}

	return $res;
}