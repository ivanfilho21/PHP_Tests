<?php

define("SQ", "'");
define("BQ", "`");
define("COMMA", ", ");

class TaskDB {
    private $tableName = "tasks";
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    private function getPseudoValuesFromArray($array) {
        $values = "";
        foreach ($array as $key => $value) {
            if (empty($value)) continue;
            $values .= BQ .$key .BQ ." = :" .$key .COMMA;
        }
        return substr($values, 0, -strlen(COMMA));
    }

    public function insert($array) {
        $values = $this->getPseudoValuesFromArray($array);

        $sql = "INSERT INTO " . BQ .$this->tableName .BQ ." SET " .$values;
        // die($sql);

        $res = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            if (empty($value)) continue;
            $res->bindValue(":" .$key, $value);
        }
        $res->execute();
    }

    public function update($id, $array) {
        $values = $this->getPseudoValuesFromArray($array);

        $sql = "UPDATE " . BQ .$this->tableName .BQ ." SET " .$values ." WHERE " .BQ ."id" .BQ ." = :id";
        $res = $this->db->prepare($sql);
        $res->bindValue(":id", $id);

        foreach ($array as $key => $value) {
            $res->bindValue(":" .$key, $value);
        }
        $res->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM " . BQ .$this->tableName .BQ ." WHERE " .BQ ."id" .BQ ." = :id";
        $res = $this->db->prepare($sql);
        $res->bindValue(":id", $id);
        $res->execute();
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