<?php

class Column
{
    private $name = "";
    private $value = "";
    private $dataType = "";
    private $length = 0;
    private $columnType = "";
    private $nullable = true;
    private $extra = "";
    private $key = "";

    public function __construct($name, $value, $dataType="", $length="", $nullable="", $extra="", $key="")
    {
        $this->setName($name);
        $this->setValue($value);
        $this->setDataType($dataType);
        $this->setLength($length);
        $this->setNullable($nullable);
        $this->setExtra($extra);
        $this->setKey($key);
    }

    public function getColumnInformation()
    {
        $info = "";
        $info .= $this->getName() . " " . $this->getColumnType() . " " . $this->getNullable() . " " . $this->getExtra() . " " . $this->getKey();

        return $info;
    }

    # Column Type

    private function createColumnType()
    {
        if (! empty($this->getDataType()) && ! empty($this->getLength())) {
            $colType = $this->getDataType() . "(" . $this->getLength() . ")";
            $this->setColumnType($colType);
        }
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
        $this->length = $length;
        $this->createColumnType();
    }

    public function setColumnType($columnType)
    {
        $this->columnType = $columnType;
    }

    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
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