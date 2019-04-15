<?php
class Uchinka_CustomGrid_Model_Resource_Grid_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('customgrid/grid');
    }

    public function joinAttributeData()
    {
        $this->join(
            array('ea' => 'eav/attribute'),
            'main_table.attribute_id=ea.attribute_id',
            array('attribute_code', 'frontend_label', 'frontend_input'));

        return $this;
    }
}