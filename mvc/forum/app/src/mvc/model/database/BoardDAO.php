<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class BoardDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("category_id", INT, 11, false),
            new Column("name", VARCHAR, 60),
            new Column("url", VARCHAR, 60),
            new Column("description", VARCHAR, 350),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Board", "boards", $columns);
    }
}