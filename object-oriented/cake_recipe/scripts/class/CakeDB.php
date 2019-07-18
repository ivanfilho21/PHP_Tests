<?php

define("SQ", "'");
define("BQ", "`");
define("COMMA", ", ");

class CakeDB {
    private $tableName = "recipe";
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;

        $this->createTable();
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ."(
            " .BQ ."id" .BQ ." INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            " .BQ ."recipe_name" .BQ ." TEXT,
            " .BQ ."recipe" .BQ ." LONGTEXT
        )";
        // echo $sql; die;
        $this->db->query($sql);
    }

    private function getPseudoValuesFromArray($array) {
        $values = "";
        foreach ($array as $key => $value) {
            if (empty($value)) continue;
            $values .= BQ .$key .BQ ." = :" .$key .COMMA;
        }
        return substr($values, 0, -strlen(COMMA));
    }

    private function bindValuesFromArray($res, $array) {
        foreach ($array as $key => $value) {
            if (empty($value)) continue;
            $res->bindValue(":" .$key, $value);
        }
    }

    public function insert($array) {
        $values = $this->getPseudoValuesFromArray($array);
        $sql = "INSERT INTO " . BQ .$this->tableName .BQ ." SET " .$values;
        $res = $this->db->prepare($sql);
        $this->bindValuesFromArray($res, $array);        
        $res->execute();

        return $this->db->lastInsertId();
    }

    public function getAll() {
        $sql = "SELECT * FROM " . BQ .$this->tableName .BQ;
        # die($sql);
        $res = $this->db->query($sql);
        $array = array();

        if ($res->rowCount() == 1)
            $array[] = $res->fetch();
        elseif ($res->rowCount() > 1)
            $array = $res->fetchAll();

        return $array;
    }
}