<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $boardId = $_POST["board"];
    $title = format($_POST["topic-title"]);
    $content = $_POST["topic-content"];

    $res = true;
    if (empty($boardId)) {
        $res = false;
        $_SESSION["error-msg"]["board"] = "Selecione uma <b>Board</b>.";
    }

    if (empty($title)) {
        $res = false;
        $_SESSION["error-msg"]["title"] = "Digite o <b>assunto</b> do Tópico.";
    }

    if (empty($content)) {
        $res = false;
        $_SESSION["error-msg"]["content"] = "O <b>conteúdo</b> do Tópico não pode ser vazio.";
    }

    if ($res) {
        $now = \IvanFilho\Date\Date::getCurrentDate();
        $topic = new \Topic(0, $this->user->getId(), $boardId, $title, $content, $now, $now, 0);
        // echo "<pre>" .print_r($topic, true) ."</pre>";

        $this->dba->getTable("topics")->insert($topic);
        redirect("home");
    }
}