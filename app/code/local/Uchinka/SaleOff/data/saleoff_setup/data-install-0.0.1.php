<?php
/* @var Mage_Catalog_Model_Resource_Setup $installer*/
$installer = $this;
$installer->startSetup();
$code = 'slide_img';
$installer->addAttribute('catalog_product', $code, array(
    'type'                       => 'varchar',
    'label'                      => 'Slide Image',
    'input'                      => 'media_image',
    'frontend'                   => 'catalog/product_attribute_frontend_image',
    'required'                   => false,
    'sort_order'                 => 5,
    'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'group'                      => 'Images',
));

$entityType = Mage::getModel('catalog/product')->getResource()->getTypeId();
$attributeSetCollection = Mage::getResourceModel('eav/entity_attribute_set_collection');
$attributeSetCollection->setEntityTypeFilter($entityType);
$attributeId = $installer->getAttributeId('catalog_product', $code);

foreach ($attributeSetCollection as $attributeSet) {
    $attributeSetId = $attributeSet->getId();
    $groupId = $installer->getAttributeGroupId('catalog_product', $attributeSetId, 'Images');
    $installer->addAttributeToSet('catalog_product', $attributeSetId, $groupId, $attributeId);
};

$installer->endSetup();