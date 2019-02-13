<?php
# TODO:
# Show sign out button in nav bar

$user = null;
$userIsLogged = false;

if (isset($_SESSION["connected_user"]))
{
	if (isset($_GET["list_me"]))
	{
		$_SESSION["connected_user"] = null;
	}
	else
	{
		$user = $_SESSION["connected_user"];
		$userIsLogged = true;
	}
}

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