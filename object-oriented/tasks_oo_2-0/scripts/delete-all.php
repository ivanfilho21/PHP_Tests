<?php

include "../config.php";
include "../class/TaskDB.php";

$taskDB = new TaskDB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ids = array();

    foreach ($_GET as $key => $value) {
        if (strpos($key, "id") !== false) {
            $ids[] = $value;
        }
    }

    foreach ($ids as $id) {
        $taskDB->delete($id);
    }
}
header("Location: ../index.php");
die;