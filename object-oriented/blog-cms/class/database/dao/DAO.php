<?php
require "class/Column.php";
require "class/database/Database.php";

abstract class DAO extends Database
{
    protected $tableName = "";
    protected $columns = array();
    protected $errorA = "Error in query";
    protected $errorB = "<br><br>Possible Causes:<br><ul><li>Table does not exist.</li><li>Database does not exist.</li></ul>";

    public function __construct() { }

    protected function createTableInDatabase($mysqli)
    {
        $fields = DatabaseUtils::getTableColumnsInline($this->columns);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->tableName . "` (" . $fields . ")";
        # echo $sql;

        $mysqli->query($sql) or die("Error in query \"" . $sql . "\"<br><br>Possible Causes:<br><ul><li>Table Already exists.</li><li>Database does not exist.</li></ul>");
    }

    protected function dropTableInDatabase($mysqli)
    {
        $sql = "DROP TABLE IF EXISTS `" . $this->tableName . "`";
        # echo $sql;

        $mysqli->query($sql) or die("Error in query \"" . $sql . "\"<br><br>Possible Causes:<br><ul><li>Table does not exist.</li><li>Database does not exist.</li></ul>");
    }

    public abstract function createTable($mysqli);
    public abstract function dropTable($mysqli);
    
    # Todo Methods: update and delete

    protected function insert($mysqli, $values)
    {
        $fields = DatabaseUtils::getTableFields($this->columns, false);
        
        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        # echo $sql;
        $mysqli->query($sql) or die("Error in query \"" . $sql . "\"" . $this->errorB);
    }
}