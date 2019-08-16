<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operation = $_POST["operation"];
    $boardId = $_POST["board"];
    $mode = $_POST["mode"];
    $type = $_POST["type"];
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

    # Check if Mode is a Correct value
    switch ($mode) {
        case \Topic::MODE_OPEN_TOPIC: break;
        case \Topic::MODE_LOCKED_TOPIC: break;
        default:
            $res = false;
            $_SESSION["error-msg"]["mode"] = "O <b>modo</b> escolhido é inválido.";
            break;
    }

    # Check if Type is a Correct value
    switch ($type) {
        case \Topic::TYPE_NORMAL_TOPIC: break;
        case \Topic::TYPE_FIXED_TOPIC: break;
        default:
            $res = false;
            $_SESSION["error-msg"]["type"] = "O <b>tipo</b> de tópico escolhido é inválido.";
            break;
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
        $now = $this->date->getCurrentDateTime();

        if ($operation == "insert") {
            $topic = new \Topic(0, $this->user->getId(), $boardId, $mode, $type, $title, $now, $now);
            $topicId = $this->dba->getTable("topics")->insert($topic);
            $post = new \Post(0, $this->user->getId(), $topicId, $content, $now, $now);
            $this->dba->getTable("posts")->insert($post);
        } elseif ($operation == "edit") {
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