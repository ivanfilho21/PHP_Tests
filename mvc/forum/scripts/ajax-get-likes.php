<?php

require "../config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $topicId = $_GET["topic"];
    $topic = (empty($topicId)) ? : $dba->getTable("topics")->get(array("id" => $topicId));
    $posts = (empty($topic)) ? : $dba->getTable("topics")->getPosts($dba, $topic);
    $allLikes = array();

    foreach ($posts as $post) {
        $postId = $post->getId();
        $postLikes = $dba->getTable("likes")->getAll(array("post_id" => $postId));
        $postLikes = (! empty($postLikes)) ? $postLikes : array();
        $allLikes[] = count($postLikes);
    }

    $response = $allLikes;
}
echo json_encode($response);