<?php

class Post
{
    public function __construct($id = "", $author_id = "", $topic_id = "", $title = "", $content = "", $update_date = "", $creation_date = "")
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->topic_id = $topic_id;
        $this->title = $title;
        $this->content = $content;
        $this->update_date = $update_date;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setAuthorId($author_id) { $this->author_id = $author_id; }
    public function getAuthorId() { return $this->author_id; }
    public function setTopicId($topic_id) { $this->topic_id = $topic_id; }
    public function getTopicId() { return $this->topic_id; }
    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }
    public function setUpdateDate($update_date) { $this->update_date = $update_date; }
    public function getUpdateDate() { return $this->update_date; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
}