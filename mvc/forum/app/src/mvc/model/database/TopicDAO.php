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
            new Column("mode", INT, 1, false),
            new Column("type", INT, 1, false),
            new Column("title", VARCHAR, 150),
            new Column("views", INT),
            new Column("url", VARCHAR, 150),
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

    public function getPost($dba, $topic, $postId)
    {
        $where = array("id" => $postId, "topic_id" => $topic->getId());
        return $dba->getTable("posts")->get($where);
    }

    public function getPosts($dba, $topic, $limit = 0, $page = 0)
    {
        $select = array();
        $where = array("topic_id" => $topic->getId());

        $limit = array("from" => $page, "qty" => $limit);
        $order = array("column" => "id", "criteria" => \IvanFilho\Database\Table::ORDER_ASC);

        $posts = $dba->getTable("posts")->getAll($where, $select, $limit, $order);
        $posts = (! empty($posts)) ? $posts : array();

        for ($i=0; $i < count($posts); $i++) {
            $author = $dba->getTable("users")->get(array("id" => $posts[$i]->getAuthorId()));
            $posts[$i]->setAuthor($author);
        }
        return $posts;
    }
}