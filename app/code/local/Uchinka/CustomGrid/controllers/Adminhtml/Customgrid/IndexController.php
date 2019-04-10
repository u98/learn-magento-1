<?php

class Uchinka_CustomGrid_Adminhtml_Customgrid_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('customgrid/adminhtml_customgrid_grid');
    }

    public function indexAction()
    {
        $this->loadLayout();
        //$this->_setActiveMenu('uchinka');
        $this->_title($this->__("Uchinka Custom Grid"));
        $this->renderLayout();
    }
}