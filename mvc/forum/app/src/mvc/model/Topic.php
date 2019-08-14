<?php

class Topic
{
    public function __construct($id = 0, $author_id = 0, $board_id = 0, $title = "", $content = "", $update_date = "", $creation_date = "", $views = 0)
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->board_id = $board_id;
        $this->title = $title;
        $this->views = $views;
        $this->content = $content;
        $this->update_date = $update_date;
        $this->creation_date = $creation_date;
        $this->author = new User();
        $this->latest_post = new Post();
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setAuthorId($author_id) { $this->author_id = $author_id; }
    public function getAuthorId() { return $this->author_id; }
    public function setBoardId($board_id) { $this->board_id = $board_id; }
    public function getBoardId() { return $this->board_id; }
    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }
    public function setContent($content) { $this->content = $content; }
    public function getContent() { return $this->content; }
    public function setUpdateDate($update_date) { $this->update_date = $update_date; }
    public function getUpdateDate() { return $this->update_date; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
    public function setViews($views) { $this->views = $views; }
    public function getViews() { return $this->views; }

    public function setAuthor($author) { $this->author = $author; }
    public function getAuthor() { return $this->author; }
    public function setLatestPost($latest_post) { $this->latest_post = $latest_post; }
    public function getLatestPost() { return $this->latest_post; }
}