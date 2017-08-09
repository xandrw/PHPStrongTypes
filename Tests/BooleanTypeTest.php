<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BooleanType.php';

class BooleanTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_giving_wrong_type_of_value()
    {
        new BooleanType('true');
    }
    
    /**
     * @test
     */
    public function it_should_create_new_boolean_type_and_verify_the_instance_value()
    {
        $trueBoolType = new BooleanType(true);
        $falseBoolType = new BooleanType(false);
        $this->assertEquals('1', $trueBoolType);
        $this->assertEquals('', $falseBoolType);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_boolean_type_and_verify_the_invoked_value()
    {
        $trueBoolType = new BooleanType(true);
        $falseBoolType = new BooleanType(false);
        $this->assertTrue($trueBoolType());
        $this->assertFalse($falseBoolType());
    }
}