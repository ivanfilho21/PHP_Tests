<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topicId = $topic->getId();
    $content = $_POST["post-content"];

    $res = true;

    if (empty($content)) {
        $res = false;
        $_SESSION["error-msg"]["content"] = "O <b>conteúdo</b> da Mensagem não pode ser vazio.";
    }

    if ($res) {
        $now = $this->date->getCurrentDateTime();
        $post = new \Post(0, $this->user->getId(), $topicId, $content, $now, $now);
        
        $this->dba->getTable("posts")->insert($post);
        redirect("topics/" .$topic->getUrl());
    }
}