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

    public function insert($array, $attach="") {
        $values = $this->getPseudoValuesFromArray($array);
        $sql = "INSERT INTO " . BQ .$this->tableName .BQ ." SET " .$values;
        $res = $this->db->prepare($sql);
        $this->bindValuesFromArray($res, $array);        
        $res->execute();

        return $this->db->lastInsertId();
    }
}