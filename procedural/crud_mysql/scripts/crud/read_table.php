<?php

if (isset($_GET["table"]))
{
	foreach ($_GET["table"] as $key => $value) {
		$name = $key;
		break;
	}
	echo "<h1>Table {$name}</h1>";
}

$columns = getTableColumns($connection, $name);

# Insert button clicked
if (isset($_POST["insert"])) {
	if (isset($_POST["data"]))
	{
		# data
		$error_msgs = array();
		$columnNames = array();
		$data = array();

		#$columns = getTableColumns($connection, $name);
		$notNullColumns = array();

		foreach ($columns as $column) {
			
			$info = getColumnInformation($connection, $name, $column);

			if ($info["IS_NULLABLE"] == "NO")
				$notNullColumns[$column] = "NO";

			# if EXTRA is empty the column has no extra info (auto_increment, etc.)

			if ($info["EXTRA"] != "auto_increment")
			{
				$columnNames[] = $column;
			}
		}

		if (validation())
		{
			insertIntoTable($connection, $name, $columnNames, $data);
			header("Location: " . $PATH . "crud/view-table.php?table[{$name}]");
		}
	}
}

primaryKey();
delete();

function validation()
{
	global $data, $notNullColumns, $error_msgs;
	$res = true;

	foreach ($_POST["data"] as $key => $value) {
		
		if (isset($notNullColumns[$key]))
		{
			if (empty($value))
			{
				$res = false;
				$error_msgs[$key] = "Can't be empty.";
			}
		}
		
		$data[] = format_input($value);
	}

	return $res;
}

function primaryKey()
{
	global $pk, $connection, $name, $columns;

	# Gets primary key in current table
	$pk = getPrimaryKey($connection, $name);

	# If empty, first column name is used as pk (might not work with some tables)

	if (empty($pk))
	{
		$cr = array_reverse($columns);
		$pk = array_pop($cr);
	}

	#echo $pk;
}

function delete()
{
	global $connection, $name, $pk;

	if (isset($_POST["delete-row"]))
	{
		$value = "";
		foreach ($_POST["delete-row"] as $key => $v) {
			#echo "key " . $key . ". value " . $v;
			$value = $key;
			break;
		}

		#echo $pk;
		
		deleteFromTable($connection, $name, $pk, $value);
	}
}