<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAddition()
    {
        $calculator = new Calculator();
        $result = $calculator->addition(1,2);
        $this->assertEquals(3,$result);
    }

    public function testAdditionParameterCheckInteger()
    {
        $calculator = new Calculator();
        $this->expectException(TypeError::class);
        $calculator->addition(6,'data');
    }


    public function testSubtract()
    {
        $calculator = new Calculator();
        $result = $calculator->subtraction(1,2);
        $this->assertEquals(-1,$result);
    }

    public function testArgumentException()
    {
        $calculator = new Calculator();
        $this->expectException(ArgumentCountError::class);
        $calculator->addition();
    }

    /**
     * @test
     * @return void
     */
    public function division_not_divided_by_zero()
    {
        $calculator = new Calculator();
        $this->expectException(DivisionByZeroError::class);
        $calculator->division(1,0);
    }

    /**
     * @test
     * @return void
     */
    public function insert_test()
    {

    }


}   