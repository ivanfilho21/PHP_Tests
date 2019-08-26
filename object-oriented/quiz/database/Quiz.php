<?php

namespace App\Database;

use \IvanFilho\Database\Table;
use \IvanFilho\Database\Column;

class Quiz extends Table
{
    public function __construct($pdo)
    {
        $c[] = new Column("id", INT, 11, false, "PRIMARY KEY", "AUTO_INCREMENT");
        $c[] = new Column("title", VARCHAR, 255);
        parent::__construct($pdo, "\Quiz", "quizes", $c);
    }

    // Using stored procedure already created in phpmyadmin
    /*public function get($where = array(), $select = array(), $limit = array(), $order = array(), $asList = false)
    {
        $quiz = array();

        $sql = $this->db->prepare("CALL sp_select_quiz(:id)");
        $id = 2;
        $this->bind($sql, ":id", 2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $object = new \Quiz();
            $quiz = $sql->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($object));
        }

        return $quiz;
    }

    private function bind($sttm, $param, $value)
    {
        $sttm->bindParam($param, $value);
    }*/
}