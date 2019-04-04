<?php

class Uchinka_CustomGrid_Block_Adminhtml_Product extends Mage_Adminhtml_Block_Catalog_Product
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->_addButton('columns', array(
            'label'   => 'Columns',
            'onclick' => 'showColumnsPopup()',
            'title'   => 'Manage Columns'
        ), -1);

        return $this;
    }
}