<?php

$quiz = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $quizId = isset($_GET["id"]) ? $_GET["id"] : "";
    if (empty($quizId)) { redirect("admin/my-quizes.php"); }

    $quiz = $dba->getTable("quizes")->get(array("id" => $quizId));
    $questions = $dba->getTable("questions")->getAll(array("quiz_id" => $quiz->getId()));

    for ($i=0; $i < count($questions); $i++) {
        $answers = $dba->getTable("answers")->getAll(array("question_id" => $questions[$i]->getId()));
        $questions[$i]->setAnswers($answers);
    }
    $quiz->setQuestions($questions);
} else {
    redirect("admin/my-quizes.php");
}