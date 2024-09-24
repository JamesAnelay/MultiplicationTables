<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Values;

class MultiplicationValue
{
    public function __construct(private ?int $x, private ?int $y)
    {
    }

    public function getValueAsArray(){
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }
}
