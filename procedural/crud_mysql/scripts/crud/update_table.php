<?php

$columnTypes = array("int", "varchar", "real", "text", "date");
$totalOfColumns = 0;
$columns = array();
$columnInfo = array();
$COL = array();
$tableName = "";

if (isset($_GET["id"]))
{
	$tableName = $_GET["id"];
}

/*
if (isset($_GET["table"]))
{
	foreach ($_GET["table"] as $key => $value) {
		$tableName = $key;
		break;
	}
}*/

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
		header("Location: update-table.php?table[{$newName}]");
		die();
	}
}

# Add column
if (isset($_POST["add-column"]))
{
	$array = $_POST["add-column"];
	$tableName = key($array);
	init();

	echo "name: {$tableName} total: " . $totalOfColumns;

	$_SESSION[$tableName]["additional-column"] = $totalOfColumns + 1;
	header("Location: update-table.php?table[{$tableName}]");
	die();
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


	# Add column
	if (isset($_SESSION[$tableName]["additional-column"]))
	{
		$totalOfColumns = $_SESSION[$tableName]["additional-column"];
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
	global $error_msgs, $tableName, $columnName, $columnNewName, $operation, $type, $COL, $columns, $totalOfColumns;
	$res = true;

	$array = $_POST["alter"];
	$tableName = key($array);

	$array = $array[$tableName];
	$operation = key($array);

	$array = $array[$operation];
	$columnName = key($array);

	if ($operation == "modify")
	{
		echo "<br>Modify Set<br>";

		
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
	if ($operation == "ADD")
	{
		echo "<br>ADD Set<br>";

		$array = $array[$columnName];
		$i = key($array);

		$col = $_POST["column".$i];

		if (empty($col["name"]))
		{
			$res = false;
			$error_msgs[$i]["name"] = "Can't be empty.";
		}
		else
			$columnName = format_input($col["name"]);

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
		}
	}
	if ($operation == "drop")
	{
		$columnIndex = key($array);
		#echo "Row " . $columnIndex . "<br>";

		init();

		# Numeric: delete last column in session
		if (is_numeric($columnIndex))
		{
			
			#echo "Total of columns: " . $totalOfColumns;

			$_SESSION[$tableName]["additional-column"] = $totalOfColumns - 1;
			header("Location: update-table.php?table[{$tableName}]");
			die();
		}
		# Non numeric: delete column in database
		else
		{
			echo "Columns: " . count($columns);
			if (count($columns) <= 1)
			{
				echo "<br><h3>Can't drop last column.</h3>";
				$res = false;
			}
		}
	}
	
	return $res;
}