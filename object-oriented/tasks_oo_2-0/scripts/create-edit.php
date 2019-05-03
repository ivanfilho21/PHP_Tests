<?php

include "../class/TaskDB.php";

$taskDB = new taskDB();

$err = array();
$task = array(
    "name" => (! empty($_POST["name"])) ? formatInput($_POST["name"]) : "",
    "description" => (! empty($_POST["description"])) ? formatInput($_POST["description"]) : "",
    "priority" => (! empty($_POST["priority"])) ? formatInput($_POST["priority"]) : "",
    "finished" => (! empty($_POST["finished"])) ? formatInput($_POST["finished"]) : "",
    "date_creation" => (! empty($_POST["created"])) ? formatInput($_POST["created"]) : date("Y-m-d"),
    "deadline" => (! empty($_POST["deadline"])) ? formatInput($_POST["deadline"]) : date("Y-m-d")
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attachment = "";
    $id = $_POST["id"];

    if (validation()) {
        if ($_POST["mode"] == "create") {
            $taskDB->insert($task, $attachment);
        } else {
            $taskDB->update($id, $task, $attachment);
        }
        
        header("Location: ../index.php");
        die;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (! empty($_GET["id"])) {
        $task = $taskDB->get($_GET["id"]);
        $attachments = $taskDB->getAttachments($_GET["id"]);
    }
}

function formatInput($input) {
    return $input;
}

function validation() {
    global $err, $task, $attachment;
    $res = true;

    $task["name"] = (! empty($_POST["name"])) ? formatInput($_POST["name"]) : $task["name"];
    $task["description"] = (! empty($_POST["description"])) ? formatInput($_POST["description"]) : $task["description"];
    $task["priority"] = (! empty($_POST["priority"])) ? formatInput($_POST["priority"]) : $task["priority"];
    $task["finished"] = (! empty($_POST["finished"])) ? formatInput($_POST["finished"]) : $task["finished"];
    $task["date_creation"] = (! empty($_POST["created"])) ? formatInput($_POST["created"]) : $task["date_creation"];
    $task["deadline"] = (! empty($_POST["deadline"])) ? formatInput($_POST["deadline"]) : $task["deadline"];

    if (empty($task["name"])) {
        $res = false;
        $err["name"] = "Specify the Task Name.";
    }

    if ($res) {
        # Attachment
        $att = (isset($_FILES["attachment"])) ? $_FILES["attachment"] : "";

        if (! empty($att)) {
            $extension = explode(".", $att["name"]);
            $extension = (count($extension) > 0) ? $extension[count($extension) -1] : "";
            $fileName = md5(time() .rand(0, 9999)) ."." .$extension;
            $path = "../attachments/" .$fileName;

            # Remove old attachments
            /*foreach ($attachments as $key => $a) {
                if (! empty($a["name"]))
                    deleteFile($a["name"]);
            }*/

            # Move attachment to folder in server
            move_uploaded_file($att["tmp_name"], $path);

            # Resize and save image
            $type = explode("/", $att["type"]);
            $type = (count($type) > 0) ? $type[0] : "";
            if ($type == "image") {
                resizeImage($att["type"], $path);
            }

            $attachment = array(
                "task_id" => "",
                "name" => $att["name"],
                "file" => $fileName
            );
        }   
    }

    return $res;
}

function resizeImage($type, $imagePath)
{
    if (! file_exists($imagePath)) return;

    list($srcWidth, $srcHeight) = getimagesize($imagePath);
    $ratio = $srcWidth / $srcHeight;
    $width = 120;
    $height = 120;

    if (($width/$height) > $ratio) {
        $width = $height * $ratio;
    }
    else {
        $height = $width / $ratio;
    }

    $img = imagecreatetruecolor($width, $height);
    
    $src = "";
    switch ($type) {
        case "image/jpeg":
            $src = imagecreatefromjpeg($imagePath);
            break;
        case "image/png":
            $src = imagecreatefrompng($imagePath);
            break;
        default:
            $src = "";
            break;
    }

    imagecopyresampled($img, $src, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
    imagejpeg($img, $imagePath, 80);
}

function deleteFile($fileName) {
    $fileName = "attachments/" .$fileName;

    if (file_exists($fileName)) {
        unlink($fileName);
    } else {
        # echo 'Could not delete '.$fileName.', file does not exist';
    }
}

function getErrorMessage($index) {
    global $err;
    echo (isset($err[$index])) ? $err[$index] : "";
}