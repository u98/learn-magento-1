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
        'primary' => true,
    ))
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
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
    ));

$adapter->createTable($table);

$installer->endSetup();