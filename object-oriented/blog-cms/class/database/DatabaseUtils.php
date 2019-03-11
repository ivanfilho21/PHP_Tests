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
    # Returns all column names, but the primary key when false
    # Expects object of class Column
    public static function getTableFields($columns, $includePK)
    {
        $fields = "";

        foreach ($columns as $column) {
        #for ($i = $start; $i < count($columns); $i++) {
            if ($column->getKey() == "PRIMARY KEY") continue;

            $fields .= QT_A . $column->getName() . QT_A . COMMA;
        }
        $fields = substr($fields, 0, strlen($fields) - strlen(COMMA));

        return $fields;
    }
    
    # Expects object of class Column
    public static function getTableColumnsInline($columns)
    {
        $fields = "";

        foreach ($columns as $column) {
            $fields .= $column->getColumnInformation() . COMMA;
        }
        $fields = substr($fields, 0, strlen($fields) - strlen(COMMA));

        return $fields;
    }
}