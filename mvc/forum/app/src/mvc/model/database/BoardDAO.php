<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class BoardDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("name", VARCHAR, 50)
        ];
        parent::__construct($pdo, "\Board", "boards", $columns);
    }

    public function insert($obj)
    {
        parent::insert($obj);
    }
}