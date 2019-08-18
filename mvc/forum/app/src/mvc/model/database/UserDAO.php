<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class UserDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("type", INT, 1, false),
            new Column("username", VARCHAR, 12),
            new Column("email", VARCHAR, 100),
            new Column("password", VARCHAR, 32),
            new Column("description", VARCHAR, 100),
            new Column("signature", TEXT),
            new Column("url", VARCHAR, 12),
            new Column("creation_date", DATETIME)
            // new Column("gender", INT, 1),
            // new Column("name", VARCHAR, 255),
            // new Column("birthday", DATE),
            // new Column("last_seen", DATETIME),
        ];

        parent::__construct($pdo, "\User", "users", $columns);
    }
}