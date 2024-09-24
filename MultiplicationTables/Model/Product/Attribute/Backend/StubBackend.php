<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Model\Product\Attribute\Backend;

class StubBackend extends StubBackendParent
{
    private array $validatedObjects = [];

    public function __construct()
    {
    }

    public function setValidator(object $exampleObject)
    {
        $this->validatedObjects[] = $exampleObject;
    }

    public function getObjectsPassedToValidateMethod()
    {
        return $this->validatedObjects;
    }
}
