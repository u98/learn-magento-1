<?php

/* @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$table_name = $installer->getTable('customgrid/grid');

$adapter = $installer->getConnection();

$table = $adapter->newTable($table_name)
    ->addColumn('column_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ))
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ))
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
    ))
    ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'default' => 0,
        'nullable' => false
    ))
    ->addColumn('width', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'default' => 0,
        'nullable' => false
    ))
    ->addColumn('editable', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null)
    ->addColumn('label', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => true,
        'default'   => ''
    ))
    ->addForeignKey($installer->getFkName(
        'customgrid/grid',
        'user_id',
        'admin/user',
        'user_id'
    ), 'user_id', 'admin_user', 'user_id', 'CASCADE')
    ->addForeignKey($installer->getFkName(
        'customgrid/grid',
        'attribute_id',
        'eav/attribute',
        'attribute_id'
    ), 'attribute_id', 'eav_attribute', 'attribute_id', 'CASCADE')
    ->addIndex(
        $installer->getIdxName(
            'customgrid/grid',
            array('user_id', 'attribute_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ), array('user_id', 'attribute_id'), array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE));

$adapter->createTable($table);

$installer->endSetup();