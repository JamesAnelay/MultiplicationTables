<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Services;

use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationXValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationYValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue;
use Magento\Framework\Stdlib\ArrayManager;

class MultiplicationValueValidator
{
    public function __construct()
    {
    }

    public function validate(MultiplicationValue $multiplicationValue)
    {
        $x = (new ArrayManager())->get('x', $multiplicationValue->getValueAsArray());
        $y = (new ArrayManager())->get('y', $multiplicationValue->getValueAsArray());

        if($x === null && $y === null){
            return true;
        }

        if($x < 1){
            throw new MultiplicationXValueMustBePositiveException("Invalid input x value must be positive");
        }

        if($y < 1){
            throw new MultiplicationYValueMustBePositiveException("Invalid input y value must be positive");
        }

        return true;
    }
}
