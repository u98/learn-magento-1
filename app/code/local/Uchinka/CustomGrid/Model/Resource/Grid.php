<?php
class Uchinka_CustomGrid_Model_Resource_Grid extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('customgrid/grid', 'column_id');
    }
}