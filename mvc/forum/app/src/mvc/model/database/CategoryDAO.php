<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class CategoryDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("name", VARCHAR, 50),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Category", "categories", $columns);
    }

    public function getBoards($dba, \Category $category)
    {
        $where = array("category_id" => $category->getId());
        $boards = $dba->getTable("boards")->getAll($where);
        $boards = (! empty($boards)) ? $boards : array();

        for ($i = 0; $i < count($boards); $i++) {
            $where = array("id" => $boards[$i]->getModeratorId());
            $mod = $dba->getTable("users")->get($where);
            
            $where = array("board_id" => $boards[$i]->getId());
            $lt = $dba->getTable("topics")->get($where);
            $lt = (! empty($lt)) ? $lt : new \Topic();

            $where = array("id" => $lt->getAuthorId());
            $author = $dba->getTable("users")->get($where);
            $lt->setAuthor($author);

            $boards[$i]->setModerator($mod);
            $boards[$i]->setLatestTopic($lt);
        }

        return $boards;
    }
}