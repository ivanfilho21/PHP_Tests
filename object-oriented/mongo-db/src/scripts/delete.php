<?php

$dbMan = new MongoDB\Driver\Manager();
$bw = new MongoDB\Driver\BulkWrite();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = ! empty($_GET["id"]) ? $_GET["id"] : "";

    if (empty($id)) redirect("index");

    $bw->delete(array("_id" => DB::getObjectId($id)));
    $dbMan->executeBulkWrite("test.megasena", $bw);
}

redirect("index");