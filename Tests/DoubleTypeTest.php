<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Types/DoubleType.php';

class DoubleTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_giving_wrong_type_of_value()
    {
        new DoubleType('13.37');
    }
    
    /**
     * @test
     */
    public function it_should_create_new_double_type_and_verify_the_instance_value()
    {
        $oneFloatType = new DoubleType(1.1);
        $twoFloatType = new DoubleType(2.2);
        $this->assertEquals('1.1', $oneFloatType);
        $this->assertEquals('2.2', $twoFloatType);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_double_type_and_verify_the_invoked_value()
    {
        $oneFloatType = new DoubleType(1.1);
        $twoFloatType = new DoubleType(2.2);
        $this->assertTrue(1.1 === $oneFloatType());
        $this->assertFalse('2.2' === $twoFloatType());
    }
}
