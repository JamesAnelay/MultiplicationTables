<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Test\Unit\Helpers;

class StubProduct
{
    public function __construct(private $data = [])
    {
    }

    public function getData($key){
        return $this->data[$key];
    }
}
