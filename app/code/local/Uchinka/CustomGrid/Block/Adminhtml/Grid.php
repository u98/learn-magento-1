<?php
class Uchinka_CustomGrid_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container {
    public function __construct()
    {
        $this->_blockGroup = 'customgrid';
        $this->_controller = 'adminhtml_customgrid';
        $this->_headerText = 'Uchinka Grid';

        parent::__construct();
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->_addButton('save', array(
            'label'   => 'Save',
            'onclick' => 'saveGrid()',
            'title'   => 'Save Grid',
            'class'   => 'save'
        ), 1);

        return $this;
    }

}