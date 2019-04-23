<?php

class WiseRobot_LoginAsCustomer_CustomerController extends Mage_Core_Controller_Front_Action
{
    public function loginAction()
    {
        $code = Mage::helper('core')->decrypt($this->getRequest()->getParam('code'));
        $customer_id = explode('.', $code)[0];
        $timestamp_admin = intval(explode('.', $code)[1]);
        $timestamp = Mage::getModel('core/date')->date('U');
        if (($timestamp - $timestamp_admin) <= 2) {
            $session = Mage::getSingleton('customer/session');
            $session->renewSession();
            $session->loginById($customer_id);
            $this->_redirect('customer/account');
        } else {
            $this->_redirect('/');
        }

    }
}