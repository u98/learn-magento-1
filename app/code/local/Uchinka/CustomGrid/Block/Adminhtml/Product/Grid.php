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



    public function __construct()
    {
        parent::__construct();
        $this->currentUserId = Mage::getSingleton('admin/session')->getUser()->getId();
    }

    protected function _prepareColumns()
    {
        if ($columns = $this->getCustomColumns()) {
            $this->addColumn('entity_id',
                array(
                    'header'=> 'ID',
                    'index' => 'entity_id',
                    'width' => '10px',
                ));
            foreach($columns as $column) {
                if ($column['status'] == '0') continue;
                $columnArr = array(
                    'header' => $column['label'] ? $column['label'] : ($column['frontend_label'] ? $column['frontend_label'] : $column['attribute_code']),
                    'index' => $column['attribute_code'],
                    'width' => $column['width'] . 'px',
                    'type'  => $column['frontend_input']
                );
                if ($columnArr['type'] === 'select') {
                    unset($columnArr['type']);
                    $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', $column['attribute_code']);
                    $allOptions = $attribute->getSource()->getAllOptions(false, true);
                    $columnArr['options']  = $allOptions;
                    $columnArr['renderer'] =  'customgrid/adminhtml_widget_grid_column_renderer_select';
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
            ->getData();
        if (count($gridModel) > 0) {
            return $gridModel;
        } else {
            return false;
        }
    }

}
