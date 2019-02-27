<?php
$editMode = false;

if (isset($_POST["edit-mode"]))
{
	#echo ($editMode) ? "true" : "false";

	$editMode = ! key($_POST["edit-mode"]);
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

		$info = getColumnInformation($connection, $name, $column);

		#TODO: check if nullable
		if ($info["IS_NULLABLE"] == "NO" && empty($value))
		{
			$error_msgs[$editID][$column] = $column . " can't be empty.";
			#echo "<br>Column: " . $column . ". ";
			#die();
		}
		else
		{
			updateTable($connection, $name, $column, $value, $pk, $editID);

			header("Location: " . $PATH . "crud/view-table.php?table[{$name}]");
			die();
		}
	}
}

#echo "Edit Mode is ";
#echo ($editMode) ? "True" : "False";
#echo "<br>ID: " . $editID;

