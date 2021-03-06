<?php

# SQL Types
define("INT", "INT");
define("VARCHAR", "VARCHAR");
define("TEXT", "TEXT");
define("LONGTEXT", "LONGTEXT");
define("MD5", "MD5");

# Useful characters
define("COMMA", ", ");
define("AND_A", " AND ");
define("QT_A", "`");
define("QT", "'");

/**
* Class: DatabaseUtils
* 
* Common operations and constants used in many classes related to the database.
*
* @package      login-system
* @subpackage   class/database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Mar 20, 2019.
*/

class DatabaseUtils
{
	/**
	* Method: getTableFields
	*
	* Returns name of columns from a given table.
	*
	* @param DAO $table: entity object that extends from DAO class.
	* @param bool $includePK: when true, the primary key will be included in fields string.
	* @param array  $whereValues: value of columns used as conditions in WHERE clause.
	* @return string.
	*
	* Last Modified: Mar 18, 2019.
	*/
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
	    #echo ($includePK) ? "true" : "false"; die();

	    foreach ($columnArray as $column) {
	    #for ($i = $start; $i < count($columnArray); $i++) {
	        if ($column->getKey() == "PRIMARY KEY") {
	        	if (! $includePK) {
	        		continue;
	        	}
	        }
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

	    #echo $fields; die();

	    return $fields;
	}

	public static function getDefaultLength($dataType)
	{
		switch ($dataType) {
		    case INT:
		        return 11;
		    case VARCHAR:
		        return 128;
		    case TEXT:
		        return 255;
		    case MD5:
		        return 32;
		    case LONGTEXT:
		        return 255;
		    default:
		        return 1;
		}
	}
}