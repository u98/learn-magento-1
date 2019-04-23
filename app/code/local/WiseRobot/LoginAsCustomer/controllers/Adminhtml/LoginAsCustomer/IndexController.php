<?php

class WiseRobot_LoginAsCustomer_Adminhtml_LoginAsCustomer_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        echo 'hello';
    }

    public function redirectAction()
    {
        /* @var Mage_Customer_Model_Session $session */
        $customer_id = $this->getRequest()->getParam('id');
        $session = Mage::getSingleton('customer/session');
        /** @var Mage_Core_Helper_Data $encryption */
        $encryption = Mage::helper('core');
        $timestamp = Mage::getModel('core/date')->date('U');
        $code = $encryption->encrypt($customer_id . '.' . $timestamp);
        $this->_redirect('loginas/customer/login', array('code' => urlencode($code)));
    }
}