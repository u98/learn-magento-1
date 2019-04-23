<?php

class WiseRobot_LoginAsCustomer_Block_Adminhtml_Customer_Grid extends Mage_Adminhtml_Block_Customer_Grid
{
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
//
//        $column = $this->getColumn('action');
//        $actions = $column->getActions();
//        $actions[] = array(
//            'caption' => 'Log in',
//            'popup' => true,
//            'url' => array(
//            'base' => 'loginas/login',
//            'field' => 'id'
//        );
//        $column->setActions( $actions );

        return $this;
    }
}