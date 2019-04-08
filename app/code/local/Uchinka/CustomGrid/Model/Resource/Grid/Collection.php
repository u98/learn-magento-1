<?php
class Uchinka_CustomGrid_Model_Resource_Grid_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('customgrid/grid');
    }
}