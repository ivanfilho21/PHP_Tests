<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class UserDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("type", INT, 1, false)
        ];

        parent::__construct($pdo, "\User", "users", $columns);
    }
}