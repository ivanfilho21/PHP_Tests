<?php

/**
* Class: DAO
* 
* Database operations related to database entities.
*
* @package      login-system
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 26, 2019.
*/

abstract class DAO
{
    protected $tableName = "";
    protected $columns = array();
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    # Getters and Setters
    public function getTableName()
    {
        return $this->tableName;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function findColumn($columnName)
    {
        $column = null;
        foreach ($this->columns as $c) {
            if ($c->getName() === $columnName) {
                $column = $c;
                break;
            }
        }
        return $column;
    }

    # Generic Table methods

    protected function create()
    {
        $fields = DatabaseUtils::getFieldsFromColumnArray($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ." (" .$fields .")";
        # echo $sql; die();

        $this->db->query($sql);
    }

    protected function drop()
    {
        $sql = "DROP TABLE IF EXISTS `" . $this->tableName . "`";
        # echo $sql; die();

        $this->db->query($sql);
    }
    
    # Executes a given query and returns the output.
    protected function executeQuery($sql)
    {
        return $this->db->query($sql);
    }

    # Todo Methods: update and delete

    # expects array with data to insert
    protected function insert($array)
    {
        $fields = DatabaseUtils::getFieldsFromColumnArray($this->columns, false, false);
        $values = DatabaseUtils::getValuesFromArray($array);
        
        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        # echo $sql; die();

        $this->db->query($sql);
    }

    # expects array of Column as where condition
    protected function delete($where)
    {
        $condition = "";

        foreach ($where as $column) {
            $condition .= QT_A .$column->getName(). QT_A . " = " . QT .$column->getValue(). QT . " AND ";
        }
        $condition = substr($condition, 0, - strlen(" AND "));
        # echo $condition; die();

        $sql = "DELETE FROM " . QT_A .$this->tableName. QT_A . " WHERE " .$condition;

        # echo $sql; die();

        $this->executeQuery($sql);
    }

    protected function select($selectColumnArray, $whereColumnArray = "")
    {
        $table = QT_A .$this->tableName .QT_A;
        $select = $this->formatSelectClause($selectColumnArray);
        $where = $this->formatWhereClause($whereColumnArray);
        
        $sql = "SELECT " .$select ." FROM " .$table .$where;
        # echo $sql; die();

        return $this->executeQuery($sql);
    }

    # Abstract methods

    public abstract function createTable();
    public abstract function dropTable();

    # Private Methods

    private function formatSelectClause($columnArray)
    {
        $clause = "";

        foreach ($columnArray as $column) {
            $clause .= BQ .$column->getName() .BQ .COMMA;
        }
        return DatabaseUtils::removeLastString($clause, COMMA);

    }

    private function formatWhereClause($columnArray = "")
    {
        $clause = "";

        if (! empty($columnArray)) {
            $clause .= " WHERE ";
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ ." = " .QT .$column->getValue() .QT .AND_A;
            }
        }
        return DatabaseUtils::removeLastString($clause, AND_A);
    }
}