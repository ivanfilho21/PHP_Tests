<?php

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class BoardDAO extends Table
{
    public function __construct(PDO $pdo)
    {
        $columns = [
            new Column("id", INT, 11, false, "AUTO_INCREMENT", "PRIMARY KEY"),
            new Column("moderator_id", INT, 11, false),
            new Column("category_id", INT, 11, false),
            new Column("name", VARCHAR, 60),
            new Column("url", VARCHAR, 60),
            new Column("description", VARCHAR, 350),
            new Column("creation_date", DATETIME)
        ];
        
        parent::__construct($pdo, "\Board", "boards", $columns);
    }

    public function getTopics($dba, $board, $limit = 1, $page = 1)
    {
        $select = array();
        $where = array("board_id" => $board->getId());
        $limitTxt = "";

        if ($limit > 1) {
            # Id starts from
            $startPoint = ($page - 1) * $limit;
            $limitTxt = ($startPoint >= 0) ? $startPoint .", " .$limit : "";
        }            

        
        $order = array(array("column" => $this->findColumn("id"), "criteria" => "DESC"));
        $topics = $dba->getTable("topics")->getAll($where, $select, $limitTxt, $order);
        $topics = (! empty($topics)) ? $topics : array();
        return $topics;
    }
}