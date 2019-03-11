<?php
$user = null;
$userIsLogged = false;

if (isset($_SESSION["connected_user"]))
{
	if (isset($_GET["sign_out"]))
	{
		$_SESSION["connected_user"] = null;
		header("Location: " . $PATH . "index.php");
	}
	else
	{
		$user = $_SESSION["connected_user"];
		$userIsLogged = true;
	}
}

# what is this doing here alone?

$tables = getTableList($connection);
# debugging
/*
foreach ($tables as $key => $value) {
	foreach ($value as $k => $v) {
		echo "<br>" . $v;
		$col = getTableColumns($connection, $v);
		foreach ($col as $index => $column) {
			foreach ($column as $i => $c) {
				echo "  " . $c;
			}
		}
	}
}
*/