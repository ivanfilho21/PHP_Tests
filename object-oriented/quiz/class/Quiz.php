<?php

class Quiz
{
    public function __construct($id = 0, $title = 0)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }

    public function setQuestions($questions) { $this->questions = $questions; }
    public function getQuestions() { return $this->questions; }
}