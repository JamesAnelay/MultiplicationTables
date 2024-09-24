<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Services;

use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationXValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationYValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue;
use Magento\Framework\Stdlib\ArrayManager;

class MultiplicationValueValidator implements MultiplicationValueValidatorInterface
{
    public function __construct()
    {
    }

    public function validate(MultiplicationValue $multiplicationValue)
    {
        $x = (new ArrayManager())->get('x', $multiplicationValue->getValueAsArray());
        $y = (new ArrayManager())->get('y', $multiplicationValue->getValueAsArray());

        if($this->bothValuesAreNotSet($x, $y)){
            return true;
        }

        if($x < 1){
            throw new MultiplicationXValueMustBePositiveException("Invalid input x value must be one or greater");
        }

        if($y < 1){
            throw new MultiplicationYValueMustBePositiveException("Invalid input y value must be one or greater");
        }

        return true;
    }

    public function bothValuesAreNotSet(mixed $x, mixed $y): bool
    {
        return $x === null && $y === null;
    }
}
