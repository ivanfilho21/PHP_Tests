<?php

$columnTypes = array("int", "varchar", "real", "text", "date");

if (isset($_GET["table"]))
{
	foreach ($_GET["table"] as $key => $value) {
		$tableName = $key;
		break;
	}
	echo "<h1>Table {$tableName}</h1>";
}

$columns = getTableColumns($connection, $tableName);
$columnInfo = array();

foreach ($columns as $key => $column) {
	$columnInfo[$key] = getColumnInformation($connection, $tableName, $column);
}

$i = 1;
foreach ($columnInfo as $key => $value) {
	echo "<br> Col {$i}: ";
	foreach ($value as $k => $v) {
		echo $k . ": " . $v . ", ";
	}
	$i++;
}

$COL = array();
foreach ($columns as $key => $column) {
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


if (isset($_POST["alter"]))
{
	$tableName = "";
	$columnName = "";
	$operation = "";
	$type = "";

	
	$array = $_POST["alter"];
	$tableName = key($array);

	$array = $array[$tableName];
	$operation = key($array);

	$array = $array[$operation];
	$columnName = key($array);

	if ($operation == "modify")
	{
		echo "<br>...<br>";
		#get type and length
		$array = $array[$columnName];
		$i = key($array);
		
		$col = $_POST["column".$i];

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
			    	#$col[$index]["length"] = "";
			    }
			    else
			    {
			    	$res = false;
			    	#$error_msgs["column_length"] = "Negative number.";
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
				#$error_msgs["column_length"] = "Invalid number.";
			    $error_msgs[$i]["length"] = "Invalid number.";
			}

			#$type .= "(" . $col["length"] . ")";
		}
	}

	# alterTable($connection, $tableName, $columnName, $operation, $type);
	#header("Location:update-table.php?table[{$tableName}]");
}