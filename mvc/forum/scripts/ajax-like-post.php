<?php

require "../config.php";

$response = "true";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $auth->getLoggedUser()->getId();
    $postId = $_POST["post"];
    $post = $dba->getTable("posts")->get(array("id" => $postId));

    if ($userId == $post->getAuthorId()) {
        // Can't like, user is the author
        $response = "false";
    } else {
        $ul = $dba->getTable("likes")->get(array("user_id" => $userId, "post_id" => $postId));
        if (! empty($ul)) {
            // Can't like, your already liked this post
            $response = "false";
        } else {
            $now = $date->getCurrentDateTime();
            $like = new Like(0, $userId, $postId, $now, $now);
            $dba->getTable("likes")->insert($like);
        }
    }
}
echo json_encode($response);