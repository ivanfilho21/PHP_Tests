<?php

namespace IvanFilho\Database;

use \PDO;
use \Exception;
use \IvanFilho\Database\Utils;

define("INT", "INT");
define("DECIMAL", "DECIMAL(8, 4)");
define("VARCHAR", "VARCHAR");
define("TEXT", "TEXT");
define("DATE", "DATE");
define("TIME", "TIME");
define("DATETIME", "DATETIME");
define("LONGTEXT", "LONGTEXT");

define("COMMA", ", ");
define("AND_A", " AND ");
define("BQ", "`"); #Backquote
define("QT", "'"); #Single Quote
define("CL", ":"); #Colon

/**
* Class: Table
* 
* Common operations related to a table in the database.
*
* Classes Dependency:
*
* \PDO
* IvanFilho\Database\Column
* IvanFilho\Database\Utils
*
* @package      Database
* @subpackage   src
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Jul 22, 2019.
* Last Modified: Jul 23, 2019.
*/

# Last modified Ago 16, 2019
# Did refactoring in code
# Returning lastInsertedId when operation is insert in prepareValues.
# Updated get and getAll methods
# Updated select method so when selectAll with whereColumns is called it will return correctly.
# Added select, where and asList params in getAll method.
# Provides a condition to the get method, when I want do a select with more than one param in WHERE query
# Local modifications that could be pushed later
# Added common public methods, so that they won't be created in every DAO class 
# Added constant LONGTEXT

abstract class Table
{
    const ORDER_ASC = "ASC";
    const ORDER_DESC = "DESC";

    private $db;
    private $columns;
    private $tableName;
    private $classType;

    public function __construct(PDO $db, String $classType, String $tableName, array $columns = array())
    {
        $this->db = $db;
        $this->classType = $classType;
        $this->tableName = $tableName;
        $this->columns = $columns;
    }

    public function setTableName($tableName) { $this->tableName = $tableName; }

    public function getName() { return $this->tableName; }

    public function setColumns($columns) { $this->columns = $columns; }
    
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
        // Exception: $this->columns is empty
        if (empty($this->columns)) {
            $class = get_class($this);
            $trace = debug_backtrace();
            // echo "<pre>" .var_export($trace[0], true) ."</pre>";

            $file = $trace[0]["file"];
            $line = $trace[0]["line"];
            $method = $trace[0]["function"] ."()";
            $parentMethod = (isset($trace[0]["args"]["0"])) ? " on " .$trace[0]["args"]["0"] ."()" : "";
            throw new Exception("Error" .$parentMethod ." during method " .$method .". Reason: array of Column \$this->columns is empty. " .$file . ":" .$line, 1);
        }

        $fields = Utils::getFieldsFromColumnArray($this->columns);
        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ." (" .$fields .")";
        // die($sql);
        $this->db->query($sql);
    }

    public function drop()
    {
        $sql = "DROP TABLE IF EXISTS " .BQ .$this->tableName .BQ;
        # echo $sql; die();
        $this->db->query($sql);
    }

    public function insert($obj)
    {
        return $this->prepareValues("insert", $obj);
    }

    public function edit($obj)
    {
        $where[] = Utils::createCondition($this, "id", $obj->getId());
        $this->update($obj, $where);
    }

    public function get($whereArray, $selectArray = array(), $order = array(), $asList = false)
    {
        $select = array();
        foreach ($selectArray as $key => $value) {
            $select[] = Utils::createSelection($this, $key);
        }

        $where = array();
        foreach ($whereArray as $key => $value) {
            $where[] = Utils::createCondition($this, $key, $value);
        }
        return $this->selectOne($select, $where, $order, $asList);
    }

    public function getAll($whereArray = array(), $selectArray = array(), $limitArray = array(), $orderArray = array(), $asList = true)
    {
        $select = array();
        $where = array();
        $order = array();
        $limit = "";

        foreach ($selectArray as $key => $value) {
            $select[] = Utils::createSelection($this, $key);
        }

        foreach ($whereArray as $key => $value) {
            $where[] = Utils::createCondition($this, $key, $value);
        }

        if (! empty($limitArray)) {
            $from = $limitArray["from"];
            $qty = $limitArray["qty"];

            if (! empty($from)) {
                $start = ($from - 1) * $qty;
                $limit = ($start >= 0) ? $start .", " .$qty : "";
            }
        }

        if (! empty($orderArray)) {
            $column = $this->findColumn($orderArray["column"]);
            $criteria = $orderArray["criteria"];

            $order = array(array("column" => $column, "criteria" => $criteria));
        }
        return $this->selectAll($select, $where, $limit, $order, $asList);
    }

    public function remove($id)
    {
        $where[] = Utils::createCondition($this, "id", $id);
        $this->delete($where);
    }

    protected function update($obj, $whereColumnArray)
    {
        $this->prepareValues("update", $obj, $whereColumnArray);
    }

    protected function delete($whereColumnArray)
    {
        $this->prepareValues("delete", null, $whereColumnArray);
    }

    protected function selectOne($select = array(), $where = array(), $order = array(), $asList = false)
    {
        $limit = 1;
        $additional = array();
        $sql = $this->createSelectSQL($select, $where, $limit, $additional, $order);
        return $this->select($sql, $where, $asList);
    }

    protected function selectAll($select = array(), $where = array(), $limit = "", $order = array(), $asList = false)
    {
        $additional = array();
        $sql = $this->createSelectSQL($select, $where, $limit, $additional, $order);
        return $this->select($sql, $where, $asList);
    }

    protected function selectWithAdditionalColumn($select=array(), $where=array(), $limit="", $additionalSelect=array(), $order=array(), $asList=false)
    {
        $sql = $this->createSelectSQL($select, $where, $limit, $additionalSelect, $order);
        return $this->select($sql, $where, $asList);
    }

    private function prepareValues($operation = "", $obj = null, $whereColumnArray = array(), $includePK = false)
    {
        // Exception: $obj is empty
        if (empty($obj)) {
            $class = get_class($this);
            $trace = debug_backtrace();
            // echo "<pre>" .var_export($trace[0], true) ."</pre>";

            $file = $trace[0]["file"];
            $line = $trace[0]["line"];
            $method = $trace[0]["function"] ."()";
            $parentMethod = (isset($trace[0]["args"]["0"])) ? " on " .$trace[0]["args"]["0"] ."()" : "";
            throw new Exception("Error on " .$parentMethod ." during method " .$method .". Reason: Object \$obj passed as param is null. " .$file . ":" .$line, 1);
        }

        $fields = Utils::getFieldsFromColumnArray($this->columns, $includePK, false);
        $pseudoValues = Utils::getPseudoValuesFromColumnArray($this->columns, $includePK);
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

        // if (($operation != "delete") empty($obj)) {
        //     return false;
        // }

        $sql .= " " .BQ .$this->tableName .BQ;
        if (! empty($obj))
            $sql .= " SET " .$pseudoValues;
        $sql .= $where;
        // die($sql ."<br>");
        $sql = $this->db->prepare($sql);

        if (! empty($obj)) {
            foreach ($this->columns as $column) {
                $columnName = $column->getName();
                $getter = Utils::getGetterFromColumnName($columnName);
                // echo "" .$getter ."() = " .$obj->$getter() ."<br>";

                if (! $includePK && $column->getKey() == "PRIMARY KEY") {
                    continue;
                }
                $sql->bindValue(CL .$columnName, $obj->$getter());
                // echo CL .$columnName . " = " . $obj->$getter() . "<br>";
            }
        }
        
        if (is_array($whereColumnArray) && count($whereColumnArray) > 0) {
            foreach ($whereColumnArray as $column) {
                $sql->bindValue(CL .$column->getName(), $column->getValue());
                 // echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
            }
        }

        $sql->execute();
        return ($operation == "insert") ? $this->db->lastInsertId() : true;
    }

    private function select($sql, $where = array(), $asList = false)
    {
        // echo $sql ."<br>"; #die();

        /*if (is_array($where) && count($where) > 0) {
            $sql = $this->db->prepare($sql);

            foreach ($where as $column) {
                $value = $column->getValue();

                if ($column->getExtra() == "like") {
                    $value = QT ."%" .$column->getValue() ."%" .QT;
                }
                echo CL .$column->getName() ." = " .$value ."<br>";
                $sql->bindValue(CL .$column->getName(), $value);
            }

            $sql->setFetchMode(PDO::FETCH_INTO, new $this->classType());
            $sql->execute();

            if ($sql->rowCount() == 1) {
                $fetch = $sql->fetch(); // $sql->fetch(PDO::FETCH_ASSOC);
                return ($asList) ? array($fetch) : $fetch;
            }
        }
        else {
            $object = new $this->classType();
            $sql = $this->db->query($sql);

            if ($sql->rowCount() == 1) {
                $fetch = $sql->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($object));
                return ($asList) ? array($fetch) : $fetch;
            }
            elseif ($sql->rowCount() > 1) {
                return $sql->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($object));
            }
        }*/

        if (is_array($where) && count($where) > 0) {
            $sql = $this->db->prepare($sql);

            foreach ($where as $column) {
                $value = $column->getValue();

                if ($column->getExtra() == "like") {
                    $value = QT ."%" .$column->getValue() ."%" .QT;
                }
                // echo CL .$column->getName() ." = " .$value ."<br>";
                $sql->bindValue(CL .$column->getName(), $value);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql);
        }

        $object = new $this->classType();

        if ($sql->rowCount() == 1) {
            # It could be a selectAll but only 1 was fetched
            $fetch = $sql->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($object));
            return (is_array($fetch)) ? (($asList) ? $fetch : $fetch[0]) : $fetch;
        }
        elseif ($sql->rowCount() > 1) {
            $fetch = $sql->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($object));
            return (is_array($fetch)) ? $fetch : array($fetch);
        }

        return ($asList) ? array() : false;
    }

    private function createSelectSQL($select = array(), $where = array(), $limit = "", $additional = array(), $order = array())
    {
        $table = BQ .$this->tableName .BQ;
        $select = $this->formatSelectClause($select);
        $select = $this->formatAdditionalSelectClause($select, $additional);
        $where = $this->formatWhereClause($where);

        $sql = "SELECT " .$select ." FROM " .$table .$where;
        // echo $sql; die;

        #var_dump($order); die();

        if (count($order) > 0) {
            $sql .= " ORDER BY ";
            foreach ($order as $o) {
                $sql .= BQ .$o["column"]->getName() .BQ ." " .$o["criteria"] .COMMA;
            }
            $sql = Utils::removeLastString($sql, COMMA);
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
                        $clause = Utils::removeLastString($clause, AND_A);
                    }

                    if (! empty($limit)) {
                        $clause .= " LIMIT " .$limit;
                    }

                    $clause .= ")";
                    $clause .= " AS " .BQ .$as .BQ .COMMA;
                }
            }
            $clause = Utils::removeLastString($clause, COMMA);
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
            $clause = Utils::removeLastString($clause, AND_A);
        }
        return $clause;
    }
}