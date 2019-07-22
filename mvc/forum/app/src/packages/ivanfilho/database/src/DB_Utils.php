<?php

namespace IvanFilho\Database;

/**
* Class: DB_Utils
* 
* Common operations and constants used in many classes related to the database.
*
* @package      IvanFilho
* @subpackage   Database
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 11, 2019.
* Last Modified: Jun 2, 2019.
*/

class DB_Utils
{
	/*public static function getDefaultLength($dataType)
	{
		switch ($dataType) {
		    case INT:
		        return 11;
		    case VARCHAR:
		        return 128;
		    case TEXT:
		        return 255;
		    default:
		        return 1;
		}
	}*/

	public function getPseudoValuesFromColumnArray($columnArray, $includePK = true)
	{
		$fields = "";
		foreach ($columnArray as $column) {
			if (! $includePK && $column->getKey() == "PRIMARY KEY") {
	        	continue;
	        }
	        $fields .= BQ .$column->getName() .BQ ." = " .CL .$column->getName() .COMMA;
		}
		$fields = DB_Utils::removeLastString($fields, COMMA);
		# echo $fields; die();
		return $fields;
	}

	public function getFieldsFromColumnArray($columnArray, $includePK=true, $fullInformation=true)
	{
		$fields = "";
		foreach ($columnArray as $column) {
			if (! $includePK && $column->getKey() == "PRIMARY KEY") {
	        	continue;
	        }
	        if ($fullInformation) {
		    	$fields .= $column->getColumnInformation();
	        }
		    else {
		    	$fields .= BQ .$column->getName() .BQ;
		    }

		    $fields .= COMMA;
		}
		$fields = DB_Utils::removeLastString($fields, COMMA);
		# echo $fields; die();
		return $fields;
	}

	public function createSelection($dao, $columnName)
	{
		return DB_Utils::getColumnByName($dao, $columnName);
	}

	public function createCondition($dao, $columnName, $value, $like = false)
	{		
		$condition = DB_Utils::getColumnByName($dao, $columnName);
		$condition->setValue($value);
		if ($like) {
			$condition->setExtra("like");
		}
		return $condition;
	}

	public function removeLastString($sourceStr, $str)
	{
		return substr($sourceStr, 0, strlen($sourceStr) - strlen($str));
	}

	private function getColumnByName($dao, $columnName)
	{
		return $dao->findColumn($columnName);
	}
}