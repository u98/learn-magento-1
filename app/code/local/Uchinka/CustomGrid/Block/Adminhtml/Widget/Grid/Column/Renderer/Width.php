<?php

class Uchinka_CustomGrid_Block_Adminhtml_Widget_Grid_Column_Renderer_Width extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return '<input type="hidden" name="hidden_attribute_id" value="' . $row->getAttributeId() . '"> <span class="u-show-first-group">'.  $row->getWidth() .'px</span> <input type="text" class="u-hidden-first-group" value="'. $row->getWidth() .'">';
    }
}