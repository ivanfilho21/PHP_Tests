<?php

$quiz = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $quizId = isset($_GET["id"]) ? $_GET["id"] : "";
    if (empty($quizId)) { redirect("admin/my-quizes.php"); }

    $quiz = $dba->getTable("quizes")->get(array("id" => $quizId));
} else {
    redirect("admin/my-quizes.php");
}