<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Unit\Test\Services;

use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationXValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationYValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Services\MultiplicationValueValidator;
use EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue;
use PHPUnit\Framework\TestCase;

class MultiplicationValueSetupServiceTest extends TestCase
{
    public function test_setup_a_value_with_posative_x_and_y_values()
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();
        $multiplicationValue = new MultiplicationValue(1, 1);
        $this->assertTrue($multiplicationValueValidator->validate($multiplicationValue));
    }

    public function test_0_x_value_will_throw_an_exception()
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();

        try{
            $multiplicationValue = new MultiplicationValue(0, 1);
            $multiplicationValueValidator->validate($multiplicationValue);
        } catch (MultiplicationXValueMustBePositiveException $exception){
            $this->assertEquals("Invalid input x value must be positive", $exception->getMessage());
            return;
        }

        $this->fail("Expected exception was not thrown");
    }

    public function test_0_y_value_will_throw_an_exception()
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();

        try{
            $multiplicationValue = new MultiplicationValue(1, 0);
            $multiplicationValueValidator->validate($multiplicationValue);
        } catch (MultiplicationYValueMustBePositiveException $exception){
            $this->assertEquals("Invalid input y value must be positive", $exception->getMessage());
            return;
        }

        $this->fail("Expected exception was not thrown");
    }
}
