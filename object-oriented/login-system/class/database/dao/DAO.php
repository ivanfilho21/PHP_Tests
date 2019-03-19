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
* Last Modified: Mar 18, 2019.
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

    protected function insert($values)
    {
        $fields = DatabaseUtils::getColumnNamesInline($this->columns, false);
        
        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        # echo $sql; die();

        $this->db->query($sql);
    }

    # Abstract Methods

    public abstract function createTable();
    public abstract function dropTable();
}