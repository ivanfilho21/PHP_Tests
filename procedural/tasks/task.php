<?php
include "config.php";
include "util.php";
include "database.php";

$validationErrors = array();

if (postSet()) {
    // Upload files
    $taskId = $_POST["task-id"];

    if (! isset($_FILES["attachment"]) || $_FILES["attachment"]["error"] != 0) {
        $validationErrors["attach"] = "You must choose a file to attach";
    } else {
        /*
        echo "<br><br>";
        foreach ($_FILES["attachment"] as $key => $v) {
            echo $key;
            echo ": ";
            echo $v;
            echo "<br>";
        }*/

        if (checkAttachment($_FILES["attachment"])) {
            $att = array();
            $att["task_id"] = $taskId;
            $att["name"] = $_FILES["attachment"]["name"];
            $att["file"] = $_FILES["attachment"]["name"];

            addAttachmentToTask($connection, $att);
        } else {
            $validationErrors["attach"] = "Wrong type of file";
        }
    }
}

$task = getTask($connection, $_GET["id"]);
$task = translateTaskFields($task);
$attachments = getAttachments($connection, $task["id"]);

include "task-template.php";

# Returns true if file type is pdf or zip, false otherwise.
function checkAttachment($file) {
    $regex = "/^.+(\.pdf|\.zip)$/";
    $res = preg_match($regex, $file["name"]);

    if (! $res)
        return false;

    $destination = "attachments/" . $file["name"];
    move_uploaded_file($file["tmp_name"], $destination);

    return true;
}