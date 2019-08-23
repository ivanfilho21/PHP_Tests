<?php

namespace IvanFilho\Database;

/**
* Class: Utils
* 
* Useful methods used in the other classes from the database package.
*
* @package      Database
* @subpackage   src
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Jul 22, 2019.
* Last Modified: Jul 23, 2019.
*/

class Utils
{
    public function createSelection($dao, $columnName)
    {
        return Utils::getColumnByName($dao, $columnName);
    }

    public function createCondition($dao, $columnName, $obj, $like = false)
    {
        $condition = Utils::getColumnByName($dao, $columnName);
        $getter = Utils::getGetterFromColumnName($columnName);
        $value = is_object($obj) ? $obj->$getter(): $obj;
        $condition->setValue($value);
        $condition->setExtra(($like) ? "like" : $condition->getExtra());
        return $condition;
    }

    public function removeLastString($sourceStr, $str)
    {
        return substr($sourceStr, 0, strlen($sourceStr) - strlen($str));
    }

    public function getGetterFromColumnName($columnName = "")
    {
        $brokenColName = explode("_", $columnName);
        $brokenColName[0] = isset($brokenColName[0]) ? ucfirst($brokenColName[0]) : "";
        $brokenColName[1] = isset($brokenColName[1]) ? ucfirst($brokenColName[1]) : "";

        $getter = "get";
        $getter .= implode("", $brokenColName);
        
        return (! empty($columnName)) ? $getter : false;
    }

    public function getPseudoValuesFromColumnArray($columnArray, $includePK = true)
    {
        $fields = "";
        foreach ($columnArray as $column) {
            if (! $includePK && $column->getKey() == "PRIMARY KEY") {
                continue;
            }
            $fields .= BQ .$column->getName() .BQ ." = " .CL .$column->getName() .COMMA;
        }
        $fields = Utils::removeLastString($fields, COMMA);
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
        $fields = Utils::removeLastString($fields, COMMA);
        # echo $fields; die();
        return $fields;
    }

    private function getColumnByName($dao, $columnName)
    {
        return $dao->findColumn($columnName);
    }
}