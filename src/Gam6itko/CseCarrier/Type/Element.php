<?php

namespace Gam6itko\CseCarrier\Structure;

class Element
{
    /** @var string */
    protected $Key;

    /** @var string */
    protected $Value;

    /** @var Element */
    protected $CultureSpecificValues;

    /** @var string */
    protected $ValueType;

    /** @var Element[] */
    protected $Properties;

    /** @var Element[] */
    protected $Fields;

    /** @var Element[] */
    protected $List;

    /** @var Element[] */
    protected $Tables;

    /** @var array */
    protected $Values;

    /** @var Row[] */
    protected $Rows;

    /** @var */
    protected $BData;

    public function __construct($Key = null, $Value = null, $ValueType = null)
    {
        $this->Key = $Key;
        $this->Value = $Value;
        $this->ValueType = $ValueType;
    }


    /**
     * @return string
     */
    public function getKey()
    {
        return $this->Key;
    }

    /**
     * @param string $Key
     * @return Element
     */
    public function setKey($Key)
    {
        $this->Key = $Key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param string $Value
     * @return Element
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
        return $this;
    }

    /**
     * @return Element
     */
    public function getCultureSpecificValues()
    {
        return $this->CultureSpecificValues;
    }

    /**
     * @param Element $CultureSpecificValues
     * @return Element
     */
    public function setCultureSpecificValues($CultureSpecificValues)
    {
        $this->CultureSpecificValues = $CultureSpecificValues;
        return $this;
    }

    /**
     * @return string
     */
    public function getValueType()
    {
        return $this->ValueType;
    }

    /**
     * @param string $ValueType
     * @return Element
     */
    public function setValueType($ValueType)
    {
        $this->ValueType = $ValueType;
        return $this;
    }

    /**
     * @return Element[]
     */
    public function getProperties()
    {
        return $this->Properties;
    }

    /**
     * @param Element[] $Properties
     * @return Element
     */
    public function setProperties($Properties)
    {
        $this->Properties = $Properties;
        return $this;
    }

    /**
     * @return Element[]
     */
    public function getFields()
    {
        return $this->Fields;
    }

    /**
     * @param Element[] $Fields
     * @return Element
     */
    public function setFields($Fields)
    {
        $this->Fields = $Fields;
        return $this;
    }

    public function hasField($fieldKeyName)
    {
        if ($this->Fields) {
            foreach ($this->Fields as $fieldElement) {
                if ($fieldElement->getKey() === $fieldKeyName) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return Element[]
     */
    public function getList()
    {
        return $this->List;
    }

    /**
     * @param Element[] $List
     * @return Element
     */
    public function setList($List)
    {
        $this->List = $List;
        return $this;
    }

    /**
     * @return Element[]
     */
    public function getTables()
    {
        return $this->Tables;
    }

    /**
     * @param Element[] $Tables
     * @return Element
     */
    public function setTables($Tables)
    {
        $this->Tables = $Tables;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->Values;
    }

    /**
     * @param array $Values
     * @return Element
     */
    public function setValues($Values)
    {
        $this->Values = $Values;
        return $this;
    }

    /**
     * @return Row[]
     */
    public function getRows()
    {
        return $this->Rows;
    }

    /**
     * @param Row[] $Rows
     * @return Element
     */
    public function setRows($Rows)
    {
        $this->Rows = $Rows;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBData()
    {
        return $this->BData;
    }

    /**
     * @param mixed $BData
     * @return Element
     */
    public function setBData($BData)
    {
        $this->BData = $BData;
        return $this;
    }


}