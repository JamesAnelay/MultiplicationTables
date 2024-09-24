<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Test\Unit\Model\Product\Attribute\Backend;

use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationXValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Model\Product\Attribute\Backend\MultiplicationValue;
use EdmondsCommerce\MultiplicationTables\Model\Product\Attribute\Backend\StubBackend;
use EdmondsCommerce\MultiplicationTables\Services\StubValidator;
use EdmondsCommerce\MultiplicationTables\Test\Unit\Helpers\StubProduct;
use Magento\Framework\Exception\LocalizedException;
use PHPUnit\Framework\TestCase;

class MultiplicationValueTest extends TestCase
{
    public function test_that_our_custom_validator_is_called()
    {
        $exampleObjectToValidate = new StubProduct(
            [
                'x_axis' => 10,
                'y_axis' => 20
            ]
        );
        $exampleObject = new StubValidator();
        $backend = new MultiplicationValue();
        $backend->setValidator($exampleObject);
        $backend->validate($exampleObjectToValidate);
        $this->assertEquals(new \EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue(10,20), $exampleObject->getValidatedParams()[0]);
    }

    public function test_that_exceptions_are_caught_and_mapped_to_localized_exceptions()
    {
        try{
            $exampleObjectToValidate = new StubProduct(
                [
                    'x_axis' => 0,
                    'y_axis' => 20
                ]
            );
            $exampleObject = new StubValidator();
            $exampleObject->setExceptionToThrow(new MultiplicationXValueMustBePositiveException("Whoops an error"));
            $backend = new MultiplicationValue();
            $backend->setValidator($exampleObject);
            $backend->validate($exampleObjectToValidate);
        }catch (LocalizedException $exception){
            $this->assertEquals("Whoops an error",$exception->getMessage());
            return;
        }
        $this->fail("Expection exception was not thrown");
    }
}
