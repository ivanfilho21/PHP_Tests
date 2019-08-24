<?php

class Question
{
    public function __construct($id = 0, $quiz_id = 0, $title = "")
    {
        $this->id = $id;
        $this->quiz_id = $quiz_id;
        $this->title = $title; 
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setQuizId($quiz_id) { $this->quiz_id = $quiz_id; }
    public function getQuizId() { return $this->quiz_id; }

    public function setTitle($title) { $this->title = $title; }
    public function getTitle() { return $this->title; }

    public function setAnswers($answers) { $this->answers = $answers; }
    public function getAnswers() { return $this->answers; }
}