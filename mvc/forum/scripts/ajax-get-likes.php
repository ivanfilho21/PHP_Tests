<?php

require "../config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET["limit"];
    $page = $_GET["page"];
    $topicId = $_GET["topic"];

    $topic = (empty($topicId)) ? : $dba->getTable("topics")->get(array("id" => $topicId));

    $select = array();
    $where = array("topic_id" => $topic->getId());
    $limit = array("from" => $page, "qty" => $limit);

    $posts = (empty($topic)) ? : $dba->getTable("posts")->getAll($where, $select, $limit);
    $allLikes = array();

    foreach ($posts as $post) {
        $postId = $post->getId();

        $where = array("post_id" => $postId);

        $postLikes = $dba->getTable("likes")->getAll($where);
        $postLikes = (! empty($postLikes)) ? $postLikes : array();
        $allLikes[] = count($postLikes);
    }

    $response = $allLikes;
}
echo json_encode($response);