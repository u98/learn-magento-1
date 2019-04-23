<?php

class Uchinka_CustomGrid_Block_Adminhtml_Widget_Grid_Column_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $media = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $value =  $row->getData($this->getColumn()->getIndex());
        if (!empty($value)) {
            $url = $media . 'catalog/product' .  $row->getData($this->getColumn()->getIndex());
            return "<a href=\"#!\" data-url=\"$url\" class='u-tooltip-media'>View</a>";
        } else {
            return '';
        }
    }
}