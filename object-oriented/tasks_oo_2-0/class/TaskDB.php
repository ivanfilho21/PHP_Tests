<?php

class TaskDB {
    private $tableName = "tasks";
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM " .$this->tableName;
        $res = $this->db->query($sql);

        if ($res->rowCount() > 0) {
            return $res->fetchAll();
        }
        return array();
    }
}