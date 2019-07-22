<?php

namespace IvanFilho\Database;

use \IvanFilho\Database\Database;
use \IvanFilho\Database\DB_Utils;

define("INT", "INT");
define("DECIMAL", "DECIMAL(8, 4)");
define("VARCHAR", "VARCHAR");
define("TEXT", "TEXT");
define("DATE", "DATE");
define("TIME", "TIME");
define("DATETIME", "DATETIME");

define("COMMA", ", ");
define("AND_A", " AND ");
define("BQ", "`"); #Backquote
define("QT", "'"); #Single Quote
define("CL", ":"); #Colon

/**
* Class: DB_Table
* 
* Common operations related to all tables in the database.
*
* @package      IvanFilho
* @subpackage   Database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Jun 18, 2019.
*/

class DB_Table
{
    private $db;
    private $columns;
    private $tableName;

    public function __construct($tableName)
    {
        $this->db = Database::getInstance()->db;
        $this->tableName = $tableName;
        $this->columns = array();
    }

    public function getName() { return $this->tableName; }
    
    public function getColumns() { return $this->columns; }
    
    public function addColumn($column) { $this->columns[] = $column; }

    public function findColumn($columnName)
    {
        $column = false;
        foreach ($this->columns as $c) {
            if ($c->getName() === $columnName) {
                $column = $c;
                break;
            }
        }
        return $column;
    }

    public function create()
    {
        $fields = DB_Utils::getFieldsFromColumnArray($this->columns);
        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ." (" .$fields .")";
        # die($sql);
        $this->db->query($sql);
    }

    public function drop()
    {
        $sql = "DROP TABLE IF EXISTS " .BQ .$this->tableName .BQ;
        # echo $sql; die();
        $this->db->query($sql);
    }

    public function insert($array)
    {
        $this->prepareValues("insert", $array);
    }

    protected function update($array, $whereColumnArray)
    {
        $this->prepareValues("update", $array, $whereColumnArray);
    }

    protected function delete($whereColumnArray)
    {
        $this->prepareValues("delete", array(), $whereColumnArray);
    }

    protected function selectOne($selectColumnArray = array(), $whereColumnArray = array(), $asList = false)
    {
        $sql = $this->createSelectSQL($selectColumnArray, $whereColumnArray, 1);
        return $this->select($sql, $whereColumnArray, $asList);
    }

    protected function selectAll($selectColumnArray = array(), $whereColumnArray = array(), $asList = false)
    {
        $sql = $this->createSelectSQL($selectColumnArray, $whereColumnArray);
        return $this->select($sql, $whereColumnArray, $asList);
    }

    protected function selectWithAdditionalColumn($select=array(), $where=array(), $limit="", $additionalSelect=array(), $order=array(), $asList=false)
    {
        $sql = $this->createSelectSQL($select, $where, $limit, $additionalSelect, $order);
        return $this->select($sql, $where, $asList);
    }

    private function prepareValues($operation = "", $array = array(), $whereColumnArray = array(), $includePK = false)
    {
        $fields = DB_Utils::getFieldsFromColumnArray($this->columns, $includePK, false);
        $pseudoValues = DB_Utils::getPseudoValuesFromColumnArray($this->columns, $includePK);
        $where = $this->formatWhereClause($whereColumnArray);

        if ($operation == "insert") {
            $sql = "INSERT INTO";
        }
        elseif ($operation == "update") {
            $sql = "UPDATE";
        }
        elseif ($operation == "delete") {
            $sql = "DELETE FROM";
        }
        else {
            return false;
        }

        if (($operation != "delete") && is_array($array) && count($array) == 0) {
            return false;
        }

        $sql .= " " .BQ .$this->tableName .BQ;
        if (is_array($array) && count($array) > 0)
            $sql .= " SET " .$pseudoValues;
        $sql .= $where;
        # echo $sql ."<br>"; die();
        $sql = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            $column = $this->findColumn($key);
            if (! $includePK && $column->getKey() == "PRIMARY KEY") {
                continue;
            }
            $columnName = $this->findColumn($key)->getName();
            $sql->bindValue(CL .$columnName, $value);
            # echo CL .$columnName . " = " . $value . "<br>";
        }

        if (is_array($whereColumnArray) && count($whereColumnArray) > 0) {
            foreach ($whereColumnArray as $column) {
                $sql->bindValue(CL .$column->getName(), $column->getValue());
                #  echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
            }
        }        

        $sql->execute();
    }

    private function select($sql, $whereColumnArray=array(), $asList=false)
    {
        # echo $sql ."<br>"; #die();

        if (is_array($whereColumnArray) && count($whereColumnArray) > 0) {
            $sql = $this->db->prepare($sql);

            foreach ($whereColumnArray as $column) {
                $value = $column->getValue();

                if ($column->getExtra() == "like") {
                    $value = QT ."%" .$column->getValue() ."%" .QT;
                }
                # echo CL .$column->getName() ." = " .$value ."<br>";
                $sql->bindValue(CL .$column->getName(), $value);
            }

            $sql->execute();
        }
        else {
            $sql = $this->db->query($sql);
        }

        if ($sql->rowCount() == 1) {
            #echo "Found 1";
            if ($asList) {
                #echo " as List.";
                $list[] = $sql->fetch();
                return $list;
            }
            return $sql->fetch();
        }
        elseif ($sql->rowCount() > 1) {
            #echo "Found " .$sql->rowCount();
            return $sql->fetchAll();
        }

        return ($asList) ? array() : false;
    }

    private function createSelectSQL($selectColumnArray=array(), $whereColumnArray=array(), $limit="", $additionalColumnArray=array(), $order=array())
    {
        $table = BQ .$this->tableName .BQ;
        $select = $this->formatSelectClause($selectColumnArray);
        $select = $this->formatAdditionalSelectClause($select, $additionalColumnArray);
        $where = $this->formatWhereClause($whereColumnArray);

        $sql = "SELECT " .$select ." FROM " .$table .$where;

        #var_dump($order); die();

        if (count($order) > 0) {
            $sql .= " ORDER BY ";
            foreach ($order as $o) {
                $sql .= BQ .$o["column"]->getName() .BQ ." " .$o["criteria"] .COMMA;
            }
            $sql = DB_Utils::removeLastString($sql, COMMA);
        }
        #$sql .= (count($order) > 0) ? " ORDER BY " .BQ .$order["column"]->getName() .BQ ." " .$order["criteria"] : "";
        $sql .= (! empty($limit)) ? " LIMIT " .$limit : "";
        #$sql .= ($limit > 0) ? " LIMIT " .$limit : "";

        return $sql;
    }

    private function formatSelectClause($columnArray=array())
    {
        $clause = "";

        if (is_array($columnArray) && count($columnArray) > 0) {
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ .COMMA;
            }
        }

        return (empty($clause)) ? "*" : $clause;
    }

    private function formatAdditionalSelectClause($selectClause, $additionalColumnArray=array())
    {
        $clause = $selectClause;

        if (is_array($additionalColumnArray) && count($additionalColumnArray) > 0) {
            $clause .= COMMA;
            foreach ($additionalColumnArray as $additional) {
                $table = $additional["name"];
                $select = $additional["select"];
                $where = $additional["where"];
                $as = $additional["as"];
                $limit = $additional["limit"];

                $clause .= "(";
                foreach ($select as $column) {
                    $clause .= "SELECT " .BQ .$table .BQ ."." .BQ .$column->getName() .BQ ." FROM " .BQ .$table .BQ ." WHERE ";

                    #echo $clause ."<br>";
                    if (count($where) > 0) {
                        foreach ($where as $whereColumn) {
                            $clause .= BQ .$table .BQ ."." .BQ .$whereColumn->getName() .BQ ." = " .BQ .$this->tableName .BQ ."." .BQ .$this->findColumn($whereColumn->getValue())->getName() .BQ .AND_A;
                        }
                        $clause = DB_Utils::removeLastString($clause, AND_A);
                    }

                    if (! empty($limit)) {
                        $clause .= " LIMIT " .$limit;
                    }

                    $clause .= ")";
                    $clause .= " AS " .BQ .$as .BQ .COMMA;
                }
            }
            $clause = DB_Utils::removeLastString($clause, COMMA);
            # echo $clause; die();
        }
        return $clause;
    }

    private function formatWhereClause($columnArray = "")
    {
        $clause = "";

        if (! empty($columnArray)) {
            $clause .= " WHERE ";
            foreach ($columnArray as $column) {
                $operator = ($column->getExtra() === "like") ? "LIKE" : "=";
                $clause .= BQ .$column->getName() .BQ ." " .$operator ." " .CL .$column->getName() .AND_A;
            }
            $clause = DB_Utils::removeLastString($clause, AND_A);
        }
        return $clause;
    }
}