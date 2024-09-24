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

    /**
     * @dataProvider provideValidExamples
     */
    public function test_a_range_of_positive_values($x, $y)
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();
        $multiplicationValue = new MultiplicationValue($x, $y);
        $this->assertTrue($multiplicationValueValidator->validate($multiplicationValue));
    }

    /**
     * @dataProvider provideValuesLessThan1
     */
    public function test_0_x_value_of_0_or_less_will_throw_an_exception($value)
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();

        try{
            $multiplicationValue = new MultiplicationValue($value, 1);
            $multiplicationValueValidator->validate($multiplicationValue);
        } catch (MultiplicationXValueMustBePositiveException $exception){
            $this->assertEquals("Invalid input x value must be one or greater", $exception->getMessage());
            return;
        }

        $this->fail("Expected exception was not thrown");
    }

    /**
     * @dataProvider provideValuesLessThan1
     */
    public function test_0_y_value_of_0_or_less_will_throw_an_exception($value)
    {
        $multiplicationValueValidator = new MultiplicationValueValidator();

        try{
            $multiplicationValue = new MultiplicationValue(1, $value);
            $multiplicationValueValidator->validate($multiplicationValue);
        } catch (MultiplicationYValueMustBePositiveException $exception){
            $this->assertEquals("Invalid input y value must be one or greater", $exception->getMessage());
            return;
        }

        $this->fail("Expected exception was not thrown");
    }

    public function provideValuesLessThan1()
    {
        return [
            [0],
            [-1],
            [-10],
            [-100]
        ];
    }

    public function provideValidExamples()
    {
        return [
            [1,1],
            [100,100],
            [200,200],
            [120,102],
            [13,99],
            [1,121313121213]
        ];
    }
}
