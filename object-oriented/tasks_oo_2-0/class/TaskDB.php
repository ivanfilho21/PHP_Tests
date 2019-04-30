<?php

define("SQ", "'");
define("BQ", "`");

class TaskDB {
    private $tableName = "tasks";
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT * FROM " . BQ .$this->tableName .BQ ." WHERE " .BQ ."id" .BQ ." = :id";
        $res = $this->db->prepare($sql);
        $res->bindValue(":id", $id);
        $res->execute();

        return ($res->rowCount() > 0) ? $res->fetch() : array();
    }

    public function getAll() {
        $sql = "SELECT * FROM " . BQ .$this->tableName .BQ;
        $res = $this->db->query($sql);
        $array = array();

        if ($res->rowCount() == 1)
            $array[] = $res->fetch();
        elseif ($res->rowCount() > 1)
            $array = $res->fetchAll();

        return $array;
    }
}