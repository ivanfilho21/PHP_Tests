<?php

include "../util.php";
include "../database.php";

$task = getTask($connection, $_GET['id']);

saveTaskTest($connection, $task);

header('Location: ../tasks_db.php');
die();