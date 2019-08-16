<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class LikeDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("user_id", INT, 11, false),
            new Column("post_id", INT, 11, false),
            new Column("update_date", DATETIME),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Like", "likes", $columns);
    }
}