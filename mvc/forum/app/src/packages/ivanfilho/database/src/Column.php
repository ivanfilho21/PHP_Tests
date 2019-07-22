<?php

namespace IvanFilho\Database;

class Column
{
    private $name = "";
    private $dataType = ""; # Name of the type. Ex: INT
    private $length = 0;
    private $columnType = ""; # Name of the type plus the length. Ex: VARCHAR(200)
    private $nullable = true;
    private $extra = "";
    private $key = "";
    private $value = "";

    public function __construct($name, $dataType, $length=0, $nullable=true, $extra="", $key="", $value="")
    {
        $this->setName($name);
        $this->setDataType($dataType);
        $this->setLength($length);
        $this->setNullable($nullable);
        $this->setExtra($extra);
        $this->setKey($key);
        $this->setValue($value);
    }

    public function getColumnInformation()
    {
        $info = "";
        $info .= BQ .$this->getName() .BQ ." " .$this->getColumnType();

        if (! empty($this->getNullable()))
            $info .= " " .$this->getNullable();

        if (! empty($this->getExtra()))
            $info .= " " .$this->getExtra();

        if (! empty($this->getKey()))
            $info .= " " .$this->getKey();

        return $info;
    }

    # Column Type

    private function createColumnType()
    {
        $colType = $this->getDataType();
        if ($this->getLength() > 0)
            $colType .= "(" . $this->getLength() . ")";

        $this->setColumnType($colType);
    }

    # Getters and Setters

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDataType()
    {
        return $this->dataType;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getColumnType()
    {
        return $this->columnType;
    }

    public function getNullable()
    {
        return $this->nullable;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
        $this->createColumnType();
    }

    public function setLength($length)
    {
        if ($length == 0) {
            #$length = DB_Utils::getDefaultLength($this->getDataType());
        }
        elseif ($length == -1) {
            # Let SQL decide the default length for this datatype; 
        }
        $this->length = $length;
        $this->createColumnType();
    }

    public function setColumnType($columnType)
    {
        $this->columnType = $columnType;
    }

    public function setNullable($nullable)
    {
        $this->nullable = ($nullable) ? "" : "NOT NULL";
    }

    public function setKey($key)
    {
        $this->key = $key;
    }
    
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }
}