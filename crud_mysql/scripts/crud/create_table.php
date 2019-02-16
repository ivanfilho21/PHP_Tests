<?php
$error_msgs = array();
$columns = 0;
$attributes = array();

$COL = array();
$SELECT = array("int", "varchar", "real", "text", "date");

# Get Columns from Session
if (isset($_SESSION["columns"]))
	$columns = $_SESSION["columns"];

# User clicked a submit button
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($columns > 0)
	{
		for ($i = 0; $i < $columns; $i++)
		{
			$col[] = $_POST["column".$i];
		}

		$COL = $col;
	}

	# Add/Del column button clicked
	if (isset($_POST["columns"]))
	{
		switch ($_POST["columns"]) {
			case "+":
				$columns++;
				break;
			case "-":
				if ($columns > 0)
					$columns--;
				break;
		}
		
		$_SESSION["columns"] = $columns;
	}
	# Create button clicked
	else
	{
		# Validation
		if (validation() && count($attributes) > 0)
		{
			#echo "<h2>Validation OK{$name}</h2>";
			createTable($connection, $name, $attributes);
		}
		#else echo "<h2>Validation Failed</h2>";
	}
}

function validation()
{
	global $name, $attributes, $columns, $error_msgs, $COL;

	$res = true;
	$name = format_input($_POST["table_name"]);
	$fields = array("name", "type", "length", "null", "pk");
	
	#echo "  TABLE: " . $name . "   ";
	# ...

	#$res = checkEmptyFields(array("table_name"));

	if (empty($name))
	{
		$res = false;
		$error_msgs["table_name"] = "Table name can't be empty.";
	}

	if ($columns == 0)
	{
		$error_msgs["columns"] = "A table must have at least one column.";
		return false;
	}
	
	$col = array();
	for ($i = 0; $i < $columns; $i++)
	{
		$col[] = $_POST["column".$i];			
	}

	# test
	/*
	foreach ($col as $index=>$value)
	{
		echo "[{$index}]:  ";
		foreach ($value as $ind=>$v)
			echo " {$ind}: " . $v;
		echo "<br>";
	}*/

	$COL = $col;

	foreach ($col as $index=>$value)
	{
		#echo "<br>";

		$colName = format_input($value["name"]);
		if (empty($colName))
		{
			$res = false;
			$error_msgs[$index]["name"] = "Name can't be empty.";
			#$error_msgs["column_name"] = "Can't be empty.";
		}
		else
			$col[$index]["name"] = strtolower($colName) . " ";

		#debug
		#echo $value["name"] . "  ";

		$col[$index]["type"] = strtoupper($value["type"]);
		
		#debug
		#echo $value["type"] . "  ";

		$colLength = format_input($value["length"]);
		if (is_numeric($colLength))
		{
		    if ((int)$colLength > 0)
		    	$col[$index]["length"] = "(" . $colLength . ")";
		    else if ((int)$colLength == 0)
		    	$col[$index]["length"] = "";
		    else
		    {
		    	$res = false;
		    	#$error_msgs["column_length"] = "Negative number.";
		    	$error_msgs[$index]["length"] = "Negative number.";
		    }
		}
		else if (empty($colLength))
		{
			if ($col[$index]["type"] == "VARCHAR")
			{
				$res = false;
				$error_msgs[$index]["length"] = "Must specify.";
			}
			else
				$col[$index]["length"] = "";
		}
		else
		{
			$res = false;
			#$error_msgs["column_length"] = "Invalid number.";
		    $error_msgs[$index]["length"] = "Invalid number.";
		}

		#debug
		#echo $value["length"] . "  ";

		if (isset($value["null"]))
			$col[$index]["null"] = " NOT NULL";

		if (isset($value["auto"]))
			$col[$index]["auto"] = " AUTO_INCREMENT";

		if (isset($value["pk"]))
			$col[$index]["pk"] = " PRIMARY KEY";

		#debug
		#if (isset($value["null"]))
		#	echo $value["null"] . "  ";
		#if (isset($value["pk"]))
		#	echo $value["pk"] . "  ";
	}

	foreach ($col as $index=>$value)
	{
		$txt = "";
		foreach ($value as $i=>$v)
		{
			$txt .= $v . " ";
		}
		$txt = substr($txt, 0, strlen($txt) - strlen(" "));
		#echo "<br>" . $txt;

		$attributes[] = $txt;
	}

	return $res;
}
