<?php

class Post
{
    public function __construct($id = "", $author_id = "", $category_id = "", $title = "", $content = "", $publish_date = "", $update_date = "", $creation_date = "")
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
        $this->title = $title;
        $this->content = $content;
        $this->publish_date = $publish_date;
        $this->update_date = $update_date;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setAuthorId($author_id) { $this->author_id = $author_id; }
    public function getAuthorId() { return $this->author_id; }
    public function setCategoryId($category_id) { $this->category_id = $category_id; }
    public function getCategoryId() { return $this->category_id; }
    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }
    public function setPublishDate($publish_date) { $this->publish_date = $publish_date; }
    public function getPublishDate() { return $this->publish_date; }
    public function setUpdateDate($update_date) { $this->update_date = $update_date; }
    public function getUpdateDate() { return $this->update_date; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
}