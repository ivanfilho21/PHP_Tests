<?php
include "../database.php";
deleteTask($connection, $_GET['id']);
header('Location: ../tasks_db.php');
die();