<?php

// unset($_SESSION["questions"]); unset($_SESSION["options"]);

if (isset($_SESSION["questions"])) {
    // echo "<b>Session Questions:</b> <pre>" .print_r($_SESSION["questions"], true) ."</pre>";
}

if (isset($_SESSION["options"])) {
    // echo "<b>Session Options:</b> <pre>" .print_r($_SESSION["options"], true) ."</pre>";
}

if (isset($_SESSION["corrects"])) {
    // echo "<b>Session Corrects:</b> <pre>" .print_r($_SESSION["corrects"], true) ."</pre>";
}
$title = (isset($_SESSION["title"])) ? $_SESSION["title"] : "";
$questions = (isset($_SESSION["questions"])) ? $_SESSION["questions"] : array("");#(isset($_POST["title"]) ? $_POST["title"] : array(""));
$options = (isset($_SESSION["options"])) ? $_SESSION["options"] : "";#(isset($_POST["answer"]) ? $_POST["answer"] : "");
$corrects = (isset($_SESSION["corrects"])) ? $_SESSION["corrects"] : array("");#(isset($_POST["correct"]) ? $_POST["correct"] : array());

if (empty($options)) {
    $options = array();
    foreach ($questions as $i => $value) {
        $options[$i][] = "";
    }
}

if (empty($corrects)) {
    $corrects = array();
    foreach ($questions as $i => $value) {
        $corrects[$i] = "0";
    }
}

// echo "<b>questions:</b> <pre>" .print_r($questions, true) ."</pre>";
// echo "<b>answers:</b> <pre>" .print_r($options, true) ."</pre>";
// echo "<b>corrects:</b> <pre>" .print_r($corrects, true) ."</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["quiz-title"];
    $questions = $_POST["title"];
    $options = $_POST["answer"];
    $correct = $_POST["correct"];
    // echo "<b>Post:</b> <pre>" .print_r($_POST, true) ."</pre>";

    if (isset($_POST["submit"])) {
        $quiz = new \Quiz(0, $title);
        $quizId = $dba->getTable("quizes")->insert($quiz);

        $questId = array();
        foreach ($questions as $i => $vq) {
            $questObj = new Question(0, $quizId, $questions[$i]);
            $questId[$i] = $dba->getTable("questions")->insert($questObj);
        }

        foreach ($options as $i => $a) {
            $corr = $corrects[$i];
            foreach ($a as $j => $content) {
                $c = ($corr == $j) ? 1 : 0;
                $answerObj = new Answer(0, $questId[$i], $c, $content);
                $dba->getTable("answers")->insert($answerObj);
            }
        }

        unset($_SESSION["questions"]);
        unset($_SESSION["options"]);

        redirect("new-quiz.php");
    } else {
        if (isset($_POST["add-question"])) {
            # Title
            $_SESSION["title"] = $title;

            # Questions
            $questions[] = "";
            $_SESSION["questions"] = $questions;
            
            # Answers
            foreach ($questions as $i => $value) {
                $options[$i] = (isset($options[$i])) ? $options[$i] : array("");
            }
            $_SESSION["options"] = $options;
            // echo "<b>Session Options:</b> <pre>" .print_r($_SESSION["options"], true) ."</pre>";

            $_SESSION["corrects"] = $corrects;
            
        } elseif (isset($_POST["add-answer"])) {
            # Title
            $_SESSION["title"] = $title;

            # Questions
            $_SESSION["questions"] = $questions;
            
            # Answers
            $qkey = $_POST["add-answer"];

            foreach ($questions as $i => $value) {
                $options[$i] = (isset($options[$i])) ? $options[$i] : array("");
                
                if ($i == $qkey) {
                    $options[$i][] = "";
                }
            }
            $_SESSION["options"] = $options;
            // echo "<b>Session Options:</b> <pre>" .print_r($_SESSION["options"], true) ."</pre>";

            $_SESSION["corrects"] = $corrects;

        } elseif (isset($_POST["remove-question"])) {
            $i = $_POST["remove-question"];
            if ($i > 0) {
                unset($_SESSION["questions"][$i]);
            }
        } elseif (isset($_POST["remove-answer"])) {
            $aux = $_POST["remove-answer"];
            $aux = explode(",", $aux);

            if (is_array($aux) && count($aux) > 0) {
                $i = $aux[0];
                $j = $aux[1];

                if ($j > 0) {
                    // echo "rem ans"; die;
                    unset($_SESSION["options"][$i][$j]);
                }
            }
        } else {
            # Do nothing
        }

        redirect("new-quiz.php");
    }
}