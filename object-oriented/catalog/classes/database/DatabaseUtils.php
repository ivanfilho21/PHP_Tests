<?php
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
* Last Modified: Mar 26, 2019.
*/

class DatabaseUtils
{
	public static function getDefaultLength($dataType)
	{
		switch ($dataType) {
		    case INT:
		        return 11;
		    case VARCHAR:
		        return 128;
		    case TEXT:
		        return 255;
		    case LONGTEXT:
		        return 255;
		    default:
		        return 1;
		}
	}

	public function getPseudoValuesFromColumnArray($columnArray, $includePK=true)
	{
		$fields = "";
		foreach ($columnArray as $column) {
			if (! $includePK && $column->getKey() == "PRIMARY KEY") {
	        	continue;
	        }
	        $fields .= $column->getName() ." = " .CL .$column->getName() .COMMA;
		}
		$fields = DatabaseUtils::removeLastString($fields, COMMA);
		# echo $fields; die();
		return $fields;
	}

	public function getValuesFromArray($array)
	{
		$values = "";
		foreach ($array as $key => $data) {
			$values .= QT .$data .QT .COMMA;
		}
		$values = DatabaseUtils::removeLastString($values, COMMA);
		# echo $values; die();
		return $values;
	}

	public function getFieldsFromColumnArray($columnArray, $includePK=true, $fullInformation=true)
	{
		$fields = "";
		foreach ($columnArray as $column) {
			if (! $includePK && $column->getKey() == "PRIMARY KEY") {
	        	continue;
	        }
	        if ($fullInformation)
		    	$fields .= $column->getColumnInformation();
		    else
		    	$fields .= $column->getName();

		    $fields .= COMMA;
		}
		$fields = DatabaseUtils::removeLastString($fields, COMMA);
		# echo $fields; die();
		return $fields;
	}

	public function removeLastString($sourceStr, $str)
	{
		return substr($sourceStr, 0, strlen($sourceStr) - strlen($str));
	}
}