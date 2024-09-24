<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Setup\Patch\Data;

use EdmondsCommerce\MultiplicationTables\Model\Product\Attribute\Backend\MultiplicationValue;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddMultiplicationAttributesToProducts implements DataPatchInterface, PatchRevertableInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private EavSetupFactory $eavSetupFactory;

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
            'x_axis',
            [
                'group'         => 'General',
                'type'          => 'varchar',
                'label'         => 'X Axis',
                'input'         => 'text',
                'source'        => '',
                'frontend'      => '',
                'backend'       => MultiplicationValue::class,
                'required'      => false,
                'sort_order'    => 50,
                'global'        => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid'               => false,
                'is_visible_in_grid'            => false,
                'is_filterable_in_grid'         => false,
                'visible'                       => true,
                'is_html_allowed_on_frontend'   => true,
                'visible_on_front'              => true,
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            'y_axis',
            [
                'group'         => 'General',
                'type'          => 'varchar',
                'label'         => 'y Axis',
                'input'         => 'text',
                'source'        => '',
                'frontend'      => '',
                'backend'       => MultiplicationValue::class,
                'required'      => false,
                'sort_order'    => 50,
                'global'        => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid'               => false,
                'is_visible_in_grid'            => false,
                'is_filterable_in_grid'         => false,
                'visible'                       => true,
                'is_html_allowed_on_frontend'   => true,
                'visible_on_front'              => true,
            ]
        );
    }

    private function removeXandYAttributes(EavSetup $eavSetup)
    {
        $eavSetup->removeAttribute(
            Product::ENTITY,
            'x_axis'
        );

        $eavSetup->removeAttribute(
            Product::ENTITY,
            'y_axis'
        );
    }
}
