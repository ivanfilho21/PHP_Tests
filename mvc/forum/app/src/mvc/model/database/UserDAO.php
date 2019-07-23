<?php

use \IvanFilho\Database\Utils;
use \IvanFilho\Database\Column;
use \IvanFilho\Database\Table;

class UserDAO extends Table
{
    public function __construct($pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "PRIMARY KEY", "AUTO_INCREMENT"),
            new Column("type", INT, 1, false)
        ];

        parent::__construct($pdo, "\User", "users", $columns);
    }
}