<?php

class Like
{
    public function __construct($id = "", $user_id = "", $post_id = "", $update_date = "", $creation_date = "")
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->update_date = $update_date;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function getUserId() { return $this->user_id; }
    public function setPostId($post_id) { $this->post_id = $post_id; }
    public function getPostId() { return $this->post_id; }
    public function setUpdateDate($update_date) { $this->update_date = $update_date; }
    public function getUpdateDate() { return $this->update_date; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
}