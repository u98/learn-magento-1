<?php

class WiseRobot_LoginAsCustomer_Block_Adminhtml_Customer_Edit extends Mage_Adminhtml_Block_Customer_Edit
{
    public function __construct()
    {
        $this->_addButton('loginascustomer', array(
            'label'   => 'Login as Customer',
//            'onclick'   => 'window.open(\'' . $this->getUrl('loginas/customer/login/id/'. $this->getCustomerId()) . '\')',
            'onclick'   => 'window.open(\'' . $this->getUrl('adminhtml/loginAsCustomer_index/redirect/id/'. $this->getCustomerId()) . '\')',
            'title'   => 'Login as Customer'

        ), 0);
        parent::__construct();
    }
}