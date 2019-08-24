<?php

namespace App\Database;

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class Quiz extends Table
{
    public function __construct($pdo)
    {
        $c[] = new Column("id", INT, 11, false, "PRIMARY KEY", "AUTO_INCREMENT");
        $c[] = new Column("title", VARCHAR, 255);
        parent::__construct($pdo, "\Quiz", "quizes", $c);
    }
}