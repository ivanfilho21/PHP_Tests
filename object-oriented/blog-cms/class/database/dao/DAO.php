<?php
require ROOT_PATH . "/class/Column.php";

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

    protected function createTableInDatabase()
    {
        $fields = DatabaseUtils::getColumnsInformationInline($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->tableName . "` (" . $fields . ")";
        # echo $sql; die();

        $this->db->query($sql);
    }

    protected function dropTableInDatabase()
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