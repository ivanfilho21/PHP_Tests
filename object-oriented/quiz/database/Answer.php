<?php

namespace App\Database;

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class Answer extends Table
{
    public function __construct($pdo)
    {
        $c[] = new Column("id", INT, 11, false, "PRIMARY KEY", "AUTO_INCREMENT");
        $c[] = new Column("question_id", INT, 11, false);
        $c[] = new Column("correct", INT, 1, false);
        $c[] = new Column("content", VARCHAR, 255);
        parent::__construct($pdo, "\Answer", "answers", $c);
    }
}