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
* Last Modified: Mar 29, 2019.
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

    # Getters
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

    public function create()
    {
        $fields = DatabaseUtils::getFieldsFromColumnArray($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS " .BQ .$this->tableName .BQ ." (" .$fields .")";
        # echo $sql; die();

        $this->db->query($sql);
    }

    public function drop()
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
    public function insert($array)
    {
        $fields = DatabaseUtils::getFieldsFromColumnArray($this->columns, false, false);
        $pseudoValues = DatabaseUtils::getPseudoValuesFromColumnArray($this->columns, false);

        $sql = "INSERT INTO " .BQ .$this->tableName .BQ ." SET " .$pseudoValues;
        # echo $sql ."<br>"; #die();
        $sql = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            $columnName = $this->findColumn($key)->getName();
            $sql->bindValue(CL .$columnName, $value);
            # echo CL .$columnName . " = " . $value . "<br>";
        }

        $sql->execute();
    }

    protected function update($array, $whereColumnArray)
    {
        $fields = DatabaseUtils::getFieldsFromColumnArray($this->columns, false, false);
        $pseudoValues = DatabaseUtils::getPseudoValuesFromColumnArray($this->columns, false);
        $where = $this->formatWhereClause($whereColumnArray);

        $sql = "UPDATE " .BQ .$this->tableName .BQ ." SET " .$pseudoValues . $where;

        # echo $sql ."<br>"; die();
        $sql = $this->db->prepare($sql);

        foreach ($array as $key => $value) {
            $columnName = $this->findColumn($key)->getName();
            $sql->bindValue(CL .$columnName, $value);
            # echo CL .$columnName . " = " . $value . "<br>";
        }

        $sql->execute();
    }

    # expects array of Column as where condition
    protected function delete($whereColumnArray)
    {
        $where = $this->formatWhereClause($whereColumnArray);

        $sql = "DELETE FROM " .BQ .$this->tableName .BQ .$where;
        # echo $sql ."<br>"; die();
        $sql = $this->db->prepare($sql);

        foreach ($whereColumnArray as $column) {
            $sql->bindValue(CL .$column->getName(), $column->getValue());
            #  echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
        }

        $sql->execute();
    }

    protected function selectOne($select=array(), $where=array(), $asList=false)
    {
        $sql = $this->createSelectSQL($select, $where, 1);
        return $this->select($sql, $where, $asList);
    }

    protected function selectAll($select=array(), $where=array(), $asList=false)
    {
        $sql = $this->createSelectSQL($select, $where);
        return $this->select($sql, $where, $asList);
    }

    protected function selectWithAdditionalColumn($select=array(), $where=array(), $limit="", $additionalSelect=array(), $additionalWhere=array(), $additionalTable="", $additionalLimit="", $asList=false)
    {
        $sql = $this->createSelectSQL($select, $where, $limit, $additionalSelect, $additionalWhere, $additionalTable, $additionalLimit);
        return $this->select($sql, $where, $asList);
    }

    private function select($sql, $whereColumnArray=array(), $asList=false)
    {
        #echo $sql ."<br>"; # die();

        if (count($whereColumnArray) > 0) {
            $sql = $this->db->prepare($sql);

            foreach ($whereColumnArray as $column) {
                $sql->bindValue(CL .$column->getName(), $column->getValue());
                #echo CL .$column->getName() . " = " . $column->getValue() . "<br>"  ;
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
        return false;
    }

    # Private Methods

    private function createSelectSQL($selectColumnArray=array(), $whereColumnArray=array(), $limit="", $additionalColumnArray=array(), $additionalWhere=array(), $additionalTable="", $additionalLimit="")
    {
        $table = BQ .$this->tableName .BQ;
        $select = $this->formatSelectClause($selectColumnArray);
        $select = $this->formatAdditionalSelectClause($select, $additionalColumnArray, $additionalWhere, $additionalTable, $additionalLimit);
        $where = $this->formatWhereClause($whereColumnArray);

        $sql = "SELECT " .$select ." FROM " .$table .$where;
        $sql .= ($limit > 0) ? " LIMIT " .$limit : "";

        return $sql;
    }

    private function formatSelectClause($columnArray=array())
    {
        $clause = "";

        if (count($columnArray) > 0) {
            foreach ($columnArray as $column) {
                $clause .= BQ .$column->getName() .BQ .COMMA;
            }
        }

        return (empty($clause)) ? "*" : $clause;
    }

    private function formatAdditionalSelectClause($selectClause, $additionalColumnArray=array(), $additionalWhere=array(), $additionalTable="", $limit="")
    {
        $clause = $selectClause;

        if (count($additionalColumnArray) > 0) {
            $clause .= COMMA;
            foreach ($additionalColumnArray as $column) {
                $clause .= "(";
                $clause .= "SELECT " .BQ .$additionalTable .BQ ."." .BQ .$column->getName() .BQ ." FROM " .BQ .$additionalTable .BQ ." WHERE ";
                
                #echo $clause ."<br>";

                if (count($additionalWhere) > 0) {
                    foreach ($additionalWhere as $whereColumn) {
                        $clause .= BQ .$additionalTable .BQ ."." .BQ .$whereColumn->getName() .BQ ." = " .BQ .$this->tableName .BQ ."." .BQ .$this->findColumn($whereColumn->getValue())->getName() .BQ .AND_A;
                        #$clause .= BQ .$additionalTable .BQ ."." .BQ .$whereColumn->getName() .BQ ." = " .BQ .$this->tableName .BQ ."." .BQ .$this->findColumn($whereColumn->getName())->getName() .BQ .AND_A;
                    }
                    $clause = DatabaseUtils::removeLastString($clause, AND_A);

                    if (! empty($limit)) {
                        $clause .= " LIMIT " .$limit;
                    }
                }
                $clause .= ")";
                $clause .= " AS " .BQ .$column->getName() .BQ .COMMA;
            }
            $clause = DatabaseUtils::removeLastString($clause, COMMA);
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
                $clause .= BQ .$column->getName() .BQ ." = " .CL .$column->getName() .AND_A;
            }
        }
        return DatabaseUtils::removeLastString($clause, AND_A);
    }
}