<?php

class Uchinka_CustomGrid_Adminhtml_Customgrid_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('customgrid/adminhtml_customgrid_grid');
    }

    public function indexAction()
    {
        Mage::getSingleton('core/session')->addError('Something not true, please try again later');
        $this->loadLayout();
        //$this->_setActiveMenu('uchinka');
        $this->_title($this->__("Uchinka Custom Grid"));

        $this->renderLayout();
    }

    protected function _getUserId()
    {
        return Mage::getSingleton('admin/session')->getUser()->getId();
    }

    public function newAction() {
        if ($this->getRequest()->isAjax())
        {
            $params = (array) $this->getRequest()->getParams();
            $row = Mage::getModel('customgrid/grid');
            $row->setUserId($this->_getUserId());
            $row->setAttributeId($params['attribute_id']);
            $row->setSortOrder(0);
            $row->setWidth($params['width']);
            $row->setEditable(0);
            $row->setLabel($params['label']);
            try {
                $row->save();
            } catch (Exception $exception) {
                return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                    'status'    => 'error',
                    'message'   => 'Error! The attribute has existed in your columns, please try again!'
                )));
            }

        }
        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($row));
    }

    public function deleteAction()
    {
        var_dump($this->getRequest()->getParams());
    }
}