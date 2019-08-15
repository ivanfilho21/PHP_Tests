<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $boardId = $_POST["board"];
    $title = format($_POST["topic-title"]);
    $content = $_POST["topic-content"];

    $res = true;
    if (empty($boardId)) {
        $res = false;
    } else {
        # Check if $boardId exists in DB
        $board = $this->dba->getTable("boards")->get(array("id" => $boardId));
        $res = ! empty($board);
    }
    if (! $res) $_SESSION["error-msg"]["board"] = "Selecione uma <b>Board</b>.";

    if (empty($title)) {
        $res = false;
        $_SESSION["error-msg"]["title"] = "Digite o <b>assunto</b> do Tópico.";
    }

    if (empty($content)) {
        $res = false;
        $_SESSION["error-msg"]["content"] = "O <b>conteúdo</b> do Tópico não pode ser vazio.";
    }

    if ($res) {
        $now = $this->date->getCurrentDateTime();
        $topic = new \Topic(0, $this->user->getId(), $boardId, $title, $now, $now, 0);
        $post = new \Post(0, $this->user->getId(), 0, $content, $now, $now);
        // echo "<pre>" .print_r($topic, true) ."</pre>";

        $id = $this->dba->getTable("topics")->insert($topic);
        if (! empty($id)) {
            $post->setTopicId($id);
            $this->dba->getTable("posts")->insert($post);
        }

        redirect("board/open/" .$board->getUrl());
    }
}