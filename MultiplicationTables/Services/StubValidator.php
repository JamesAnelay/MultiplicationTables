<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Services;

use EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue;
use Magento\Setup\Exception;

class StubValidator implements MultiplicationValueValidatorInterface
{
    private array $validatedValues = [];
    private ?\Exception $exceptionToThrow = null;

    public function __construct()
    {
    }

    public function getValidatedParams()
    {
        return $this->validatedValues;
    }

    public function setExceptionToThrow(\Exception $exception){
        $this->exceptionToThrow = $exception;
    }

    public function validate(MultiplicationValue $multiplicationValue)
    {
        $this->validatedValues[] = $multiplicationValue;
        if($this->exceptionToThrow !== null) {
            throw $this->exceptionToThrow;
        }
    }
}
