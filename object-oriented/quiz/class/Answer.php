<?php

class Answer
{
    public function __construct($id = 0, $answer_id)
    {
        $this->id = $id;
        $this->answer_id = $answer_id;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
}