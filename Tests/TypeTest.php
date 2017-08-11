<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Type.php';

class TypeTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        Type::alias('StringMock', 'string');
    }
    
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
        Type::alias('StringMock', 'string');
    }
    
    /**
     * @test
     */
    public function it_should_add_an_alias_and_instantiate_an_aliased_type_class()
    {
        $value = '1337';
        $stringType = new StringMockType($value);
        
        $this->assertEquals($value, $stringType);
        $this->assertEquals($value, $stringType());
    }
}

class StringMockType extends Type {}