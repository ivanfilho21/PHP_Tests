<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mode = $_POST["mode"];
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

        if ($mode == "insert") {
            $topic = new \Topic(0, $this->user->getId(), $boardId, $title, $now, $now);
            $topicId = $this->dba->getTable("topics")->insert($topic);
            $post = new \Post(0, $this->user->getId(), $topicId, $content, $now, $now);
            $this->dba->getTable("posts")->insert($post);
        } elseif ($mode == "edit") {
            if ($topic->getPostId() == $post->getId()) {
                $topic->setTitle($title);
                $topic->setBoardId($boardId);
                $topic->setUpdateDate($now);
                $this->dba->getTable("topics")->edit($topic);

                $post->setContent($content);
                $post->setUpdateDate($now);
                $this->dba->getTable("posts")->edit($post);
            }
        }

        redirect("boards/" .$board->getUrl());
    }
}