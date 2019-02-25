<?php

if (isset($_GET["delete-table"]))
	deleteTable();

function deleteTable()
{
	global $connection;
	
	if (isset($_GET["delete-table"]))
	{
		foreach ($_GET["delete-table"] as $key => $v)
		{
			#echo $key . " ";
			dropTable($connection, $key);
			header("Location:index.php");
		}

	}
}