<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class PostDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("author_id", INT),
            new Column("category_id", INT),
            new Column("title", VARCHAR, 150),
            new Column("content", LONGTEXT),
            new Column("publish_date", DATETIME),
            new Column("update_date", DATETIME),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Post", "posts", $columns);
    }
}