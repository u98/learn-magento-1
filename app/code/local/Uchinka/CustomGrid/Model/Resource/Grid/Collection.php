<?php
class Uchinka_CustomGrid_Model_Grid_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('customgrid/grid');
    }
}