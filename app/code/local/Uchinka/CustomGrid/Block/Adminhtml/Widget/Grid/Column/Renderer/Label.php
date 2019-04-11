<?php

class Uchinka_CustomGrid_Block_Adminhtml_Widget_Grid_Column_Renderer_Label extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ($row->getLabel())
        {
            return '<span class="u-show-first-group"> '. $row->getLabel() .'(*) </span><input type="text" class="u-hidden-first-group" value="'. $row->getLabel() .'">';
        }
        if ($row->getFrontendLabel())
        {
            return '<span class="u-show-first-group"> '. $row->getFrontendLabel() .'</span><input type="text" class="u-hidden-first-group" value="'. $row->getFrontendLabel() .'">';

        }
        return '<span class="u-show-first-group"> '. $row->getAttributeCode() .'</span><input type="text" class="u-hidden-first-group" value="'. $row->getAttributeCode() .'">';

    }
}