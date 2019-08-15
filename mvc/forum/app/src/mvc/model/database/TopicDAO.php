<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class TopicDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("author_id", INT, 11, false),
            new Column("board_id", INT, 11, false),
            new Column("title", VARCHAR, 150),
            new Column("views", INT),
            new Column("url", VARCHAR, 60),
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
        return $this->get($where, array(), $order);
    }

    public function getAuthor($dba, $topic)
    {
        $where = array("id" => $topic->getAuthorId());
        return $dba->getTable("users")->get($where);
    }

    public function getPosts($dba, $topic)
    {
        $where = array("topic_id" => $topic->getId());
        $posts = $dba->getTable("posts")->getAll($where);
        $posts = (! empty($posts)) ? $posts : array();
        for ($i=0; $i < count($posts); $i++) {
            $author = $dba->getTable("users")->get(array("id" => $posts[$i]->getAuthorId()));
            $posts[$i]->setAuthor($author);
        }
        return $posts;
    }
}