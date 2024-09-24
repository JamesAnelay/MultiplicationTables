<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Services;

use EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue;

interface MultiplicationValueValidatorInterface
{
    public function validate(MultiplicationValue $multiplicationValue);
}
