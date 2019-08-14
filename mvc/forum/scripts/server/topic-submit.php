<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $boardId = $_POST["board"];
    $title = $_POST["topic-title"];
    $content = $_POST["topic-content"];

    $res = true;
    if (empty($boardId)) {
        $res = false;
    }

    if (empty($title)) {
        $res = false;
    }

    if (empty($content)) {
        $res = false;
    }

    if ($res) {
        $now = date("Y-m-d H:i:s");
        $topic = new \Topic(0, $this->user->getId(), $boardId, $title, $content, $now, $now, 0);
        // echo "<pre>" .print_r($topic, true) ."</pre>";

        $this->dba->getTable("topics")->insert($topic);
    }
}