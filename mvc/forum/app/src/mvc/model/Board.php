<?php

class Board
{
    public function __construct($id = "", $category_id = "", $name = "", $url = "", $description = "", $creation_date = "")
    {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->url = $url;
        $this->description = $description;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setCategoryId($category_id) { $this->category_id = $category_id; }
    public function getCategoryId() { return $this->category_id; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setUrl($url) { $this->url = $url; }
    public function getUrl() { return $this->url; }
    public function setDescription($description) { $this->description = $description; }
    public function getDescription() { return $this->description; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
}