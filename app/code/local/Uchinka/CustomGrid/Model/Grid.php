<?php

class Uchinka_CustomGrid_Model_Grid extends Mage_Core_Model_Abstract
{


    protected function _construct()
    {
        $this->_init('customgrid/grid');
    }

    public function getFormattedWidth()
    {
        return "{$this->getWidth()}px";
    }

    public function getCustomLabel()
    {
        if ($this->getLabel())
        {
            return $this->getLabel() . ' (*)';
        }
        if ($this->getFrontendLabel())
        {
            return $this->getFrontendLabel();
        }
        return $this->getAttributeCode();
    }


}