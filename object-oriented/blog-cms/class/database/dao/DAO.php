<?php

require "../class/Column.php";

abstract class DAO
{
    protected $tableName = "";
    protected $columns = array();
    protected $errorA = "Error in query";
    protected $errorB = "<br><br>Possible Causes:<br><ul><li>Table does not exist.</li><li>Database does not exist.</li></ul>";

    public function __construct() { }

    # Getters and Setters
    public function getColumns()
    {
        return $this->columns;
    }

    # Other methods

    protected function createTableInDatabase($mysqli)
    {
        $fields = DatabaseUtils::getColumnsInformationInline($this->columns);

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
        $fields = DatabaseUtils::getColumnNamesInline($this->columns, false);
        
        $sql = "INSERT INTO " . QT_A . $this->tableName . QT_A . " (" . $fields . ") VALUES (" . $values . ")";
        # echo $sql;
        $mysqli->query($sql) or die("Error in query \"" . $sql . "\"" . $this->errorB);
    }
}