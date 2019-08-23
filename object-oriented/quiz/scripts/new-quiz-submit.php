<?php

// unset($_SESSION["questions"]); unset($_SESSION["answers"]);

$_SESSION["questions"] = (isset($_SESSION["questions"])) ? $_SESSION["questions"] : array("");
$questions = $_SESSION["questions"];

$answers = (isset($_SESSION["answers"])) ? $_SESSION["answers"] : array();
if (empty($answers)) {
    foreach ($questions as $key => $value) {
        $answers[$key][] = "";
    }
}

// echo "Questions: <pre>" .print_r($questions, true) ."</pre>";
// echo "Answers: <pre>" .print_r($answers, true) ."</pre>";

$titles = (isset($_POST["title"])) ? $_POST["title"] : array();
$options = (isset($_POST["answer"])) ? $_POST["answer"] : array();
$rights = (isset($_POST["right"])) ? $_POST["right"] : array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<pre>" .print_r($_POST, true) ."</pre>";

    if (isset($_POST["submit"])) {
        #
    } else {
        if (isset($_POST["add-question"])) {
            $questions[] = "";
            $_SESSION["questions"] = $questions;
        } elseif (isset($_POST["remove-question"])) {
            $i = $_POST["remove-question"];
            if ($i > 0) {
                unset($_SESSION["questions"][$i]);
            }
        } elseif (isset($_POST["add-answer"])) {
            $i = $_POST["add-answer"];
            $answers[$i][] = "";
            $_SESSION["answers"] = $answers;
        } elseif (isset($_POST["remove-answer"])) {
            $aux = $_POST["remove-answer"];
            $aux = explode(",", $aux);
            if (is_array($aux) && count($aux) > 0) {
                $i = $aux[0];
                $j = $aux[1];

                if ($j > 0) {
                    // echo "rem ans"; die;
                    unset($_SESSION["answers"][$i][$j]);
                }
            }
        }
        header("location: new-quiz.php");
        die;
    }
}