<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Types/IntegerType.php';

class IntegerTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_giving_wrong_type_of_value()
    {
        new IntegerType('1337');
    }
    
    /**
     * @test
     */
    public function it_should_create_new_integer_type_and_verify_the_instance_value()
    {
        $oneIntType = new IntegerType(1);
        $twoIntType = new IntegerType(2);
        $this->assertEquals('1', $oneIntType);
        $this->assertEquals('2', $twoIntType);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_integer_type_and_verify_the_invoked_value()
    {
        $oneIntType = new IntegerType(1);
        $twoIntType = new IntegerType(2);
        $this->assertTrue(1 === $oneIntType());
        $this->assertFalse('2' === $twoIntType());
    }
}
