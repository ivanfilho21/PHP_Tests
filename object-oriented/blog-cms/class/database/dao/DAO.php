<?php
require ROOT_PATH . "/class/Column.php";

abstract class DAO
{
    protected $tableName = "";
    protected $columns = array();
    protected $db;
    protected $errorA = "Error in query";
    protected $errorB = "<br><br>Possible Causes:<br><ul><li>Table does not exist.</li><li>Database does not exist.</li></ul>";

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

    # Other methods

    protected function createTableInDatabase()
    {
        $fields = DatabaseUtils::getColumnsInformationInline($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->tableName . "` (" . $fields . ")";
        # echo $sql;

        $this->db->query($sql) or die("Error in query \"" . $sql . "\"<br><br>Possible Causes:<br><ul><li>Table Already exists.</li><li>Database does not exist.</li></ul>");
    }

    protected function dropTableInDatabase()
    {
        $sql = "DROP TABLE IF EXISTS `" . $this->tableName . "`";
        # echo $sql;

        $this->db->query($sql) or die("Error in query \"" . $sql . "\"<br><br>Possible Causes:<br><ul><li>Table does not exist.</li><li>Database does not exist.</li></ul>");
    }

    public abstract function createTable();
    public abstract function dropTable();
    
    # Todo Methods: update and delete

    protected function insert($values)
    {
        $fields = DatabaseUtils::getColumnNamesInline($this->columns, false);
        
        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        # echo $sql;
        $this->db->query($sql) or die("Error in query \"" . $sql . "\"" . $this->errorB);
    }
}