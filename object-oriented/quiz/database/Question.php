<?php

namespace App\Database;

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class Question extends Table
{
    public function __construct($pdo)
    {
        $c[] = new Column("id", INT, 11, false, "PRIMARY KEY", "AUTO_INCREMENT");
        $c[] = new Column("quiz_id", INT, 11, false);
        $c[] = new Column("title", VARCHAR, 255);
        parent::__construct($pdo, "\Question", "questions", $c);
    }
}