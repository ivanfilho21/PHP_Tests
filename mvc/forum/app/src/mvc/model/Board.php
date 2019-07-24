<?php

class Board
{
    public function __construct($id = "", $name = "")
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
}