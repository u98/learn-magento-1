<?php

class Uchinka_CustomGrid_Block_Adminhtml_Widget_Grid_Column_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return "<span class='custom-grid-btn btn-edit' data-id='{$row->getId()}' style='background-image: url({$this->getSkinUrl('images/icon_edit_address.gif')});'></span>" .
            "<span class='custom-grid-btn btn-delete' data-id='{$row->getId()}' data-url='{$this->getUrl('adminhtml/customgrid_index/delete', array('id' => $row->getId()))}' style='background-image: url({$this->getSkinUrl('images/icon_btn_delete.gif')});'></span>";
    }
}