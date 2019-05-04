<?php

include "../config.php";
include "../class/TaskDB.php";

$taskDB = new TaskDB();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (! empty($_GET["id"])) {
        $id = $_GET["id"];
        $task = $taskDB->get($id);
        $attachments = $taskDB->getAttachments($id);
        unset($task["id"]);

        for ($i=0; $i < count($task); $i++) {
            unset($task[$i]);
        }

        for ($i=0; $i < count($attachments); $i++) {
            unset($attachments[$i]["id"]);
            
            for ($j=0; $j < count($attachments[$i]); $j++) {
                unset($attachments[$i][$j]);
            }
        }
        $newId = $taskDB->insert($task);

        foreach ($attachments as $a) {
            $a["task_id"] = $newId;
            $taskDB->insertAttachment($a);
        }
        
    }
}
header("Location: ../index.php");
die;