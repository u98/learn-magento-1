<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2019 Magento, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Uchinka_CustomGrid_Block_Adminhtml_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{

    private $currentUserId = null;

    private $columns = null;



    public function __construct()
    {
        parent::__construct();
        $this->currentUserId = Mage::getSingleton('admin/session')->getUser()->getId();
        $this->columns = $this->getCustomColumns();
    }

    protected function _prepareCollection()
    {
        $store = $this->_getStore();

        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('attribute_set_id')
            ->addAttributeToSelect('type_id');

        if ($store->getId()) {
            $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
            $collection->addStoreFilter($store);
            foreach ($this->columns as $column) {

                if ($column['backend_type'] !== 'static') {
                    $collection->joinAttribute(
                        $column['attribute_code'],
                        'catalog_product/'. $column['attribute_code'],
                        'entity_id',
                        null,
                        'inner',
                        $adminStore
                    );
                }
            }
        } else {
            foreach($this->columns as $column) {
                if ($column['backend_type'] !== 'static') {
                    $collection->joinAttribute($column['attribute_code'], 'catalog_product/' . $column['attribute_code'], 'entity_id', null, 'left');
                }
            }
            $collection->addAttributeToSelect('price');
        }
        $this->setCollection($collection);

        get_parent_class(get_parent_class($this))::_prepareCollection();
        $this->getCollection()->addWebsiteNamesToResult();
        return $this;
    }

    protected function _getSelectOptions($attrOptions)
    {
        $options = array();
        foreach ($attrOptions as $option) {
            $options[$option['value']] = $option['label'];
        }

        return $options;
    }

    protected function _prepareColumns()
    {
        if ($this->columns) {
            $this->addColumn('entity_id',
                array(
                    'header'=> 'ID',
                    'index' => 'entity_id',
                    'width' => '10px',
                ));
            $eav_config = Mage::getModel('eav/config');
            foreach($this->columns as $column) {
                if ($column['status'] == '0') continue;
                $columnArr = array(
                    'header' => $column['label'] ? $column['label'] : ($column['frontend_label'] ? $column['frontend_label'] : $column['attribute_code']),
                    'index' => $column['attribute_code'],
                    'width' => $column['width'] . 'px',
                    'type'  => $column['frontend_input']
                );
                if ($columnArr['type'] === 'select') {
                    $columnArr['type'] = 'options';
                    $attribute = $eav_config->getAttribute('catalog_product', $column['attribute_code']);
                    $allOptions = $attribute->getSource()->getAllOptions(false, true);
                    $columnArr['options']  = $this->_getSelectOptions($allOptions);
                    //$columnArr['renderer'] =  'customgrid/adminhtml_widget_grid_column_renderer_select';
                }
                if (in_array($column['attribute_code'], ['created_at', 'updated_at'])) {
                    $columnArr['type'] = 'datetime';
                }
                if ($column['frontend_input'] === 'price') {
                    $store = $this->_getStore();
                    $columnArr['currency_code'] = $store->getBaseCurrency()->getCode();
                    $columnArr['header_css_class'] = 'f-right';
                }
                if ($column['frontend_input'] === 'media_image') {
                    $columnArr['renderer'] = 'customgrid/adminhtml_widget_grid_column_renderer_image';
                }
                $this->addColumn($column['attribute_code'], $columnArr);
            }
            $this->addColumn('action',
                array(
                    'header'    => Mage::helper('catalog')->__('Action'),
                    'width'     => '20px',
                    'type'      => 'action',
                    'getter'     => 'getId',
                    'actions'   => array(
                        array(
                            'caption' => Mage::helper('catalog')->__('Edit'),
                            'url'     => array(
                                'base'=>'*/*/edit',
                                'params'=>array('store'=>$this->getRequest()->getParam('store'))
                            ),
                            'field'   => 'id'
                        )
                    ),
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => 'stores',
                ));

            if (Mage::helper('catalog')->isModuleEnabled('Mage_Rss')) {
                $this->addRssList('rss/catalog/notifystock', Mage::helper('catalog')->__('Notify Low Stock RSS'));
            }
        } else {
            parent::_prepareColumns();
        }
        return $this;
    }


    public function getCustomColumns() {
        $gridModel = Mage::getModel('customgrid/grid')->getCollection()->addFieldToFilter('user_id', $this->currentUserId)
            ->joinAttributeData()
            ->setOrder('sort_order', 'ASC')
            ->getData();
        if (count($gridModel) > 0) {
            return $gridModel;
        } else {
            return false;
        }
    }

    public function getRowUrl($item)
    {
        return '';
    }

}
