<?php
require ROOT_PATH . "/class/Column.php";

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
* Last Modified: Mar 20, 2019.
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
        $fields = DatabaseUtils::getColumnsInformationInline($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->tableName . "` (" . $fields . ")";
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

    # expects string as values
    protected function insert($values)
    {
        $fields = DatabaseUtils::getColumnNamesInline($this->columns, false);
        
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
        $this->db->query($sql);
    }

    protected function select($whereColumnArray = "")
    {
        # WORKING IN
        # http://localhost/dev/php-tests/object-oriented/login-system/auth/new-password.php?selector=91d6eccb330ebaf3&validator=79f4dca21d18736782ad949685a61740b0d00b892027bea4160e6d71a2c26364

        $select = "*";
        
        $sql = "SELECT " .$select. " FROM ";
        echo $sql; die();
    }

    # Abstract Methods

    public abstract function createTable();
    public abstract function dropTable();
}