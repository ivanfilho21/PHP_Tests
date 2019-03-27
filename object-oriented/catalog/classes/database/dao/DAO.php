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
* Last Modified: Mar 27, 2019.
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
        $pseudoValues = DatabaseUtils::getPseudoValuesFromColumnArray($this->columns, false);

        $sql = "INSERT INTO " .QT_A .$this->tableName .QT_A ." SET " .$pseudoValues;
        # echo $sql; die();
        $sql = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            $sql->bindValue(CL .$this->findColumn($key)->getName(), $value);   
        }

        $sql->execute();
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

    protected function select($selectColumnArray=array(), $whereColumnArray=array(), $additionalColumnArray=array(), $additionalTable="", $additionalWhere=array(), $limit="")
    {
        $table = QT_A .$this->tableName .QT_A;
        $select = $this->formatSelectClause($selectColumnArray, $additionalColumnArray, $additionalTable, $additionalWhere, $limit);
        $where = $this->formatWhereClause($whereColumnArray);
        
        $sql = "SELECT " .$select ." FROM " .$table .$where;
        #echo $sql; die();
        
        if (! empty($where)) {
            $sql = $this->db->prepare($sql);

            foreach ($whereColumnArray as $column) {
                $sql->bindValue(CL .$column->getName(), $column->getValue());
                # echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
            }

            $sql->execute();
        }
        else {
            $sql = $this->db->query($sql);
        }

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
            /*foreach ($sql->fetchAll() as $obj) {
                #return $obj;
                $list[] = $obj;
            }
            return $list;*/
        }
        return false;
    }

    # Abstract methods

    public abstract function createTable();
    public abstract function dropTable();

    # Private Methods

    private function formatSelectClause($columnArray=array(), $additionalColumnArray=array(), $additionalTable="", $additionalWhere=array(), $limit="")
    {
        #if ($columnArray === "*" && count($additionalColumnArray) == 0) return $columnArray;
        $clause = "";

        if (count($columnArray) > 0) {
            /*if ($columnArray !== "*") {
                
            }
            else {
                $clause = $columnArray .COMMA;
            }*/
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ .COMMA;
            }
        }
        if (count($additionalColumnArray) > 0) {
            foreach ($additionalColumnArray as $column) {
                $clause .= "(";
                $clause .= "SELECT " .BQ .$additionalTable .BQ ."." .BQ .$column->getName() .BQ ." FROM " .BQ .$additionalTable .BQ ." WHERE ";

                if (count($additionalWhere) > 0) {
                    foreach ($additionalWhere as $whereColumn) {
                        $clause .= BQ .$additionalTable .BQ ."." .BQ .$whereColumn->getName() .BQ ." = " .BQ .$this->tableName .BQ ."." .BQ .$this->findColumn($whereColumn->getName())->getName() .BQ .AND_A;
                    }
                    $clause = DatabaseUtils::removeLastString($clause, AND_A);

                    if (! empty($limit)) {
                        $clause .= " LIMIT " .$limit;
                    }
                }

                $clause .= ")";
            }
            # echo $clause; die();
        }
        else {
            #$clause = DatabaseUtils::removeLastString($clause, COMMA);
        }

        return (empty($clause)) ? "*" : $clause;
    }

    private function formatWhereClause($columnArray = "")
    {
        $clause = "";

        if (! empty($columnArray)) {
            $clause .= " WHERE ";
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ ." = " .CL .$column->getName() .AND_A;
            }
        }
        return DatabaseUtils::removeLastString($clause, AND_A);
    }
}