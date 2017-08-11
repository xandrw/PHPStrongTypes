<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Type.php';

class TypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_trying_to_make_a_value_from_the_abstract_type_class()
    {
        Type::make('value');
    }
    
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_trying_to_add_duplicate_alias()
    {
        Type::alias('StringMock', '1337');
        Type::alias('StringMock', '1337');
    }
    
    /**
     * @test
     */
    public function it_should_add_an_alias_and_instantiate_an_aliased_type_class()
    {
        Type::alias('StringMock', 'string');
        
        $value = '1337';
        $stringType = new StringMockType($value);
        
        $this->assertEquals($value, $stringType);
        $this->assertEquals($value, $stringType());
    }
}

class StringMockType extends Type {}