<?php

class Answer
{
    public function __construct($id = 0, $question_id = 0, $correct = 0, $content = "")
    {
        $this->id = $id;
        $this->question_id = $question_id;
        $this->correct = $correct;
        $this->content = $content;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setQuestionId($question_id) { $this->question_id = $question_id; }
    public function getQuestionId() { return $this->question_id; }

    public function setCorrect($correct) { $this->correct = $correct; }
    public function getCorrect() { return $this->correct; }

    public function setContent($content) { $this->content = $content; }
    public function getContent() { return $this->content; }
}