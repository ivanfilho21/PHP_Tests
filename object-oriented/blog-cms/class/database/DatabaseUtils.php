<?php
# SQL Types
define("INT", "INT");
define("VARCHAR", "VARCHAR");
define("MD5", "MD5");

# Useful characters
define("COMMA", ", ");
define("QT_A", "`");
define("QT", "'");

class DatabaseUtils
{
    # Connects to database and returns the connection
    public static function getDatabaseConnection($dsn, $dbuser, $dbpass)
    {
        $pdo = null;

        try {
            $pdo = new PDO($dsn, $dbuser, $dbpass);
            # echo "Connected to Database via PDO<br>";
        } catch(PDOException $e) {
            echo "Warning: Failed connecting to database.<br><strong>Returned Error:</strong> " .$e->getMessage() . "<br>";
        }
        return $pdo;
    }

    # Returns a string containing all column names
    # from a given array of class/Columns.php got from
    # a given DAO table.
    # The primary key column name is ignored when false
    # Expects array of objects of class class/Column.php
    public static function getTableFields(DAO $table, bool $includePK)
    {
        $columnArray = $table->getColumns();
        return DatabaseUtils::getColumnNamesInline($columnArray, $includePK);
    }

    # Returns all column names, but the primary key when false
    # Expects array of objects of class class/Column.php
    public static function getColumnNamesInline(array $columnArray, bool $includePK)
    {
        $fields = "";

        foreach ($columnArray as $column) {
        #for ($i = $start; $i < count($columnArray); $i++) {
            if ($column->getKey() == "PRIMARY KEY") continue;

            $fields .= QT_A . $column->getName() . QT_A . COMMA;
        }
        $fields = substr($fields, 0, strlen($fields) - strlen(COMMA));

        return $fields;
    }
    
    # Returns a string containing all column information
    # from a given array of class/Columns.php
    public static function getColumnsInformationInline(array $columnArray)#getTableColumnsInline(array $columnArray)
    {
        $fields = "";

        foreach ($columnArray as $column) {
            $fields .= $column->getColumnInformation() . COMMA;
        }
        $fields = substr($fields, 0, strlen($fields) - strlen(COMMA));

        return $fields;
    }
}