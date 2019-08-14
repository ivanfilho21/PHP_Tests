<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class TopicDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("author_id", INT),
            new Column("board_id", INT),
            new Column("title", VARCHAR, 150),
            new Column("content", LONGTEXT),
            new Column("update_date", DATETIME),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Topic", "topics", $columns);
    }

    public function getLatest($boardId)
    {
        $order = array(
            array(
                "column" => $this->findColumn("id"),
                "criteria" => "DESC"
            )
        );
        $where = array("board_id" => $boardId);
        return $this->get($where, null, $order);
    }

    public function getAuthor($dba, $topic)
    {
        $where = array("id" => $topic->getAuthorId());
        return $dba->getTable("users")->get($where, null);
    }
}