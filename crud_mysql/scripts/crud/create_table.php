<?php

$error_msgs = array();
$columns = 0;
$name = "";
$attributes = array();

# Get Columns from Session
if (isset($_SESSION["columns"]))
	$columns = $_SESSION["columns"];

# User clicked a submit button
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
			echo "<h2>Validation OK{$name}</h2>";
			createTable($connection, $name, $attributes);
		}
		else echo "<h2>Validation Failed</h2>";
	}
}

function validation()
{
	global $name, $attributes, $columns, $error_msgs;

	$res = true;
	$name = $_POST["table_name"];
	$fields = array("name", "type", "length", "null", "pk");
	echo "  TABLE: " . $name . "   ";
	# ...

	$res = checkEmptyFields(array("table_name"));
	
	# test
	$col = array();
	for ($i = 0; $i < $columns; $i++)
	{
		$col[] = $_POST["column".$i];			
	}
	foreach ($col as $index=>$value)
	{
		echo "[{$index}]:  ";
		foreach ($value as $ind=>$v)
			echo " {$ind}: " . $v;
		echo "<br>";
	}

	foreach ($col as $index=>$value)
	{
		echo "<br>";
		if (empty($value["name"]))
		{
			$res = false;
			$error_msgs["name"] = "Can't be empty.";
		}
		else
			$col[$index]["name"] = strtolower($value["name"]) . " ";

		#debug
		#echo $value["name"] . "  ";

		$col[$index]["type"] = strtoupper($value["type"]);
		
		#debug
		#echo $value["type"] . "  ";

		if ((int)$value["length"] < 0)
		{
			$res = false;
			# err
		}
		else if ((int)$value["length"] == 0)
			$col[$index]["length"] = "";
		else
			$col[$index]["length"] = "(" . $value["length"] . ")";

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
		echo "<br>" . $txt;

		$attributes[] = $txt;
	}

	return $res;
}