<?php
class Uchinka_CustomGrid_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container {
    protected $_addButtonLabel = null;
    public function __construct()
    {
        $this->_blockGroup = 'customgrid';
        $this->_controller = 'adminhtml_customgrid';
        $this->_headerText = 'Uchinka Grid';

        parent::__construct();

        $this->setTemplate('uchinka/custom_grid/container.phtml');
        $this->_addButton('add', array(
            'label'     => 'Add new column',
            'onclick'   => 'showCreateColumn()',
            'class'     => 'add',
            'id'        => 'u-btn-add-column'
        ));
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

    protected function _getUserId()
    {
        return Mage::getSingleton('admin/session')->getUser()->getId();
    }

    protected function getAllAttribute()
    {
        $result = Mage::getResourceModel('eav/entity_attribute_collection')
            ->addFieldToFilter('entity_type_id', 4)
            ->addFieldToSelect(array('attribute_id', 'attribute_code', 'frontend_input', 'frontend_label'));


        return $result;


    }

}