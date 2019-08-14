<?php

class Category
{
    public function __construct($id = 0, $name = "", $creation_date = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }
}