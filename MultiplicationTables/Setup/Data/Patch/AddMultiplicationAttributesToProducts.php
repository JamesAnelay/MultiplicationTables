<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Setup\Data\Patch;

use EdmondsCommerce\MultiplicationTables\Test\Unit\Setup\Data\Patch\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddMultiplicationAttributesToProducts implements DataPatchInterface, PatchRevertableInterface
{
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->setupXandYAttributes($this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]));
    }

    public function revert()
    {
        $this->removeXandYAttributes($this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]));
    }

    private function setupXandYAttributes(EavSetup $eavSetup)
    {
        $eavSetup->addAttribute(
            Product::ENTITY,
            'x-axis',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'X Axis',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => false,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => '',
                'used_in_product_listing' => true
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'x-axis',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Y Axis',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => false,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => '',
                'used_in_product_listing' => true
            ]
        );
    }

    private function removeXandYAttributes(EavSetup $eavSetup)
    {
        $eavSetup->removeAttribute(
            Product::ENTITY,
            'x-axis'
        );

        $eavSetup->removeAttribute(
            Product::ENTITY,
            'x-axis'
        );
    }
}
