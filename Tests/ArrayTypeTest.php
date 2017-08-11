<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Types/ArrayType.php';

class ArrayTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_giving_wrong_type_of_value()
    {
        new ArrayType(1337);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_array_type_and_verify_the_instance_value()
    {
        $value = [1, 2, 3];
        $arrayType = new ArrayType($value);
        $this->assertEquals(serialize($value), $arrayType);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_array_type_and_verify_the_invoked_value()
    {
        $value = [1, 2, 3];
        $arrayType = new ArrayType($value);
        $this->assertEquals($value, $arrayType());
        $this->assertTrue($value === $arrayType());
    }
}
