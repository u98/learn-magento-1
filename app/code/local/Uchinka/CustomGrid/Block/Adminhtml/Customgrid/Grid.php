<?php

class Uchinka_CustomGrid_Block_Adminhtml_Customgrid_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected $_filterVisibility = false;

    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('sort_order');
        $this->setId('customgrid_grid');
        $this->setDefaultDir('asc');
        $this->setSortable(false);
        $this->setDefaultLimit(20);
//        $this->setSaveParametersInSession(true);
    }

    protected function _afterLoadCollection() {
        $attributeIds = [];
        foreach ($this->_collection->getItems() as $item) {
            $attributeIds[] = $item->getData();
        }
        $this->setData('current_attribute_ids', $attributeIds);
    }


    protected function _prepareCollection()
    {
        /** @var Uchinka_CustomGrid_Model_Resource_Grid_Collection $collection */
        $collection = Mage::getResourceModel('customgrid/grid_collection');
        $collection->joinAttributeData()
            ->addFieldToFilter('user_id', $this->_getUserId());

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('column_id',
            array(
                'header'=> $this->__('ID'),
                'width' => '30',
                'index' => 'column_id',
                'type'  => 'number'
            )
        );
        $this->addColumn('attribute_code',
            array(
                'header'=> $this->__('Attribute'),
                'index' => 'attribute_code',
            )
        );

        $this->addColumn('label',
            array(
                'header'     => 'Label',
                'renderer'   => 'customgrid/adminhtml_widget_grid_column_renderer_label',
            )
        );

        $this->addColumn('sort_order',
            array(
                'header'=> 'Sort order',
                'index' => 'sort_order',
                'type'  => 'number',
            )
        );

        $this->addColumn('width',
            array(
                'header'=> 'Width',
                'renderer'   => 'customgrid/adminhtml_widget_grid_column_renderer_width',
            )
        );

        $this->addColumn('status', array(
            'header'    => 'Enable',
            'type'      => 'checkbox',
            'value'     => '1',
            'index'     => 'status'
        ));

        $this->addColumn('action',
            array(
                'header'    => 'Action',
                'renderer'  => 'customgrid/adminhtml_widget_grid_column_renderer_action',
                'filter'    => false
            ));



        return parent::_prepareColumns(); // TODO: Change the autogenerated stub
    }

    protected function _getUserId()
    {
        return Mage::getSingleton('admin/session')->getUser()->getId();
    }

    public function getRowUrl($item)
    {
        return '';
    }
}