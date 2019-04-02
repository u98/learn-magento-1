<?php

class Uchinka_SaleOff_Model_System_Config_Source_GetCategories {
    public function toOptionArray ()
    {
        $code = Mage::getSingleton('adminhtml/config_data')->getWebsite();
        $category_id = Mage::app()->getWebsite($code)->getDefaultGroup()->getRootCategoryId();
        $categories = Mage::getModel('catalog/category')->getCategories($category_id, 5, false, true, true);
        $result = [];
        foreach($categories as $item) {
            $prefix = str_repeat('|--', $item->getLevel() - 2);
            $result[] = array('value' => $item->getId(), 'label' => $prefix .' '.$item->getName());
        }

        return $result;
    }
}