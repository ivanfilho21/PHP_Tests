<?php
$editMode = false;

if (isset($_POST["edit-mode"]))
{
	$editMode = true;
}

if (isset($_POST["edit-row"]))
{
	$array = $_POST["edit-row"];

	$editID = key($array);
	
	$array = $array[$editID];
	$column = key($array);

	if (isset($_POST[$column]))
	{
		$value = $_POST[$column];
		updateTable($connection, $name, $column, $value, $pk, $editID);

		header("Location: " . $PATH . "crud/view-table.php?table[{$name}]");
		die();
	}
}

echo "Edit Mode is ";
echo ($editMode) ? "True" : "False";

