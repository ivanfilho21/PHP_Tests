<?php

class Board
{
    public function __construct($id = 0, $moderator_id = 0, $category_id = 0, $name = "", $description = "", $creation_date = "", $url = "")
    {
        $this->id = $id;
        $this->moderator_id = $moderator_id;
        $this->category_id = $category_id;
        $this->setName($name);
        $this->description = $description;
        $this->creation_date = $creation_date;
        
        $this->latest_topic = new Topic();
        $this->moderator = new User();
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setCategoryId($category_id) { $this->category_id = $category_id; }
    public function getCategoryId() { return $this->category_id; }
    public function setModeratorId($moderator_id) { $this->moderator_id = $moderator_id; }
    public function getModeratorId() { return $this->moderator_id; }
    public function setName($name) { $this->name = $name; $this->url = encodeUrlFromName($name); }
    public function getName() { return $this->name; }
    public function setDescription($description) { $this->description = $description; }
    public function getDescription() { return $this->description; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }

    public function setUrl($url) { $this->url = $url; }
    public function getUrl() { return $this->url; }
    public function setModerator($moderator) { $this->moderator = $moderator; }
    public function getModerator() { return $this->moderator; }
    public function setLatestTopic($latest_topic) { $this->latest_topic = $latest_topic; }
    public function getLatestTopic() { return $this->latest_topic; }
}