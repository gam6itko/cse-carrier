<?php
namespace Gam6itko\CseCarrier\Structure;

class Row
{
    /** @var array */
    protected $Cells;

    /** @var Row[] */
    protected $Rows;

    /** @var Element[] */
    protected $Properties;

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->Cells;
    }

    /**
     * @param array $Cells
     * @return Row
     */
    public function setCells($Cells)
    {
        $this->Cells = $Cells;
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
     * @return Row
     */
    public function setRows($Rows)
    {
        $this->Rows = $Rows;
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
     * @return Row
     */
    public function setProperties($Properties)
    {
        $this->Properties = $Properties;
        return $this;
    }


}