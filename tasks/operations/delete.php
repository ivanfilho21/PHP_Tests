<?php
include "../database.php";

if (isset($_GET["id"]))
{
	deleteTask($connection, $_GET['id']);
	header("Location: ../tasks_db.php");
	die();
}
if (isset($_GET["all"]))
{
	deleteAllTasks($connection);
	header("Location: ../tasks_db.php");
	die();
}