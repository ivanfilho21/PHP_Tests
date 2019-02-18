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
