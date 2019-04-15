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


        }
        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($row));
    }

    public function deleteAction()
    {
        var_dump($this->getRequest()->getParams());
    }

    public function saveAction()
    {
        if ($this->getRequest()->isAjax()) {
            $data = json_decode($this->getRequest()->getParam(data));

            $deleted = $this->getRequest()->getParam('deleted');
            if ($deleted) {
                foreach ($deleted as $item) {
                    $row = Mage::getModel('customgrid/grid');
                    $row->load($item);
                    try {
                        $row->delete();
                    } catch (Exception $exception) {
                        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                            'status' => 'error',
                            'message' => 'Error! The attribute has existed in your columns, please try again!'
                        )));
                    }
                }
            }

            foreach($data as $item) {
                if ($item->is_add_new) {
                    $row = Mage::getModel('customgrid/grid');
                    $row->setUserId($this->_getUserId());
                    $row->setAttributeId($item->attribute_id);
                    $row->setSortOrder($item->sort_order);
                    $row->setWidth($item->width);
                    $row->setEditable(0);
                    if ($item->label)
                        $row->setLabel($item->label);
                    else
                        $row->setLabel(null);
                    try {
                        $row->save();
                    } catch (Exception $exception) {
                        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                            'status'    => 'error',
                            'message'   => 'Error! The attribute has existed in your columns, please try again!'
                        )));
                    }
                } else {
                    $row = Mage::getModel('customgrid/grid');
                    $row->load($item->column_id);
                    if ($row && $row->getSortOrder() !== $item->sort_order) {
                        $row->setSortOrder($item->sort_order);
                        $row->save();
                    }
                }
                if ($item->is_updated) {
                    $row->setLabel($item->label);
                    $row->setWidth($item->width);
                    $row->setStatus($item->status);
                    $row->save();
                }
            }
            return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                'status'    => 'success',
                'message'   => 'Saved your product columns setting is success, close the popup to see new result!'
            )));
        }
    }
}