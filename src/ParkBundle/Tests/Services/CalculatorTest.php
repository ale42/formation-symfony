<?php

namespace ParkBundle\Tests\Services;

use ParkBundle\Services\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testSumInteger(){
        $calc = new Calculator();
        $result = $calc->sumInteger(15, 20);

        $this->assertEquals(35, $result);
    }
}
