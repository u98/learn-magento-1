<?php

/* @var Mage_Core_Model_Resource_Setup $installer */

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('customgrid/grid'),
    'status',
    "TINYINT(1) NOT NULL DEFAULT 1"
);

$installer->endSetup();
