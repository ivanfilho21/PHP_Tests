<?php

require "../config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $response = validation();
}

echo json_encode($response);

function validation()
{
    $res = array();
    $all = isset($_GET["all"]) ? true : false;
    $res["finished"] = "false";

    foreach ($_GET as $key => $value) {
        $res[$key] = "";
    }

    $title = isset($_GET["title"]) ? $_GET["title"] : "";
    $boardId = isset($_GET["board-id"]) ? $_GET["board-id"] : "";
    $content = isset($_GET["content"]) ? $_GET["content"] : "";

    if (empty($title)) {
        $res["title"] = $all ? 0 : "Dê um título ao Tópico.";
    }

    return $res;
}