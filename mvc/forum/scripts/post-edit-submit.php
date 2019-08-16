<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST["post-id"];
    $content = $_POST["post-content"];

    $res = true;

    if (empty($postId)) {
        $res = false;
        redirect("topics/" .$topic->getUrl());
    }

    if (empty($content)) {
        $res = false;
        $_SESSION["error-msg"]["content"] = "O <b>conteúdo</b> da Mensagem não pode ser vazio.";
    }

    if ($res) {
        if (empty($editPost)) redirect("topics/" .$topic->getUrl());

        $now = $this->date->getCurrentDateTime();
        // $editPost = new \Post(0, $this->user->getId(), $topicId, $content, $now, $now);
        
        $editPost->setContent($content);
        $editPost->setUpdateDate($now);

        $this->dba->getTable("posts")->edit($editPost);
        redirect("topics/" .$topic->getUrl());
    }
}