<?php

$quizes = $dba->getTable("quizes")->getAll();

for ($i=0; $i < count($quizes); $i++) {
    $questions = $dba->getTable("questions")->getAll(array("quiz_id" => $quizes[$i]->getId()));

    for ($j=0; $j < count($questions); $j++) {
        $answers = $dba->getTable("answers")->getAll(array("question_id" => $questions[$j]->getId()));
        $questions[$j]->setAnswers($answers);
    }
    $quizes[$i]->setQuestions($questions);
}