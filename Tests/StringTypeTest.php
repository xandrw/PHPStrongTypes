<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Types/StringType.php';

class StringTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_fail_when_giving_wrong_type_of_value()
    {
        new StringType(1337);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_string_type_and_verify_the_instance_value()
    {
        $stringType = new StringType('string');
        $this->assertEquals('string', $stringType);
    }
    
    /**
     * @test
     */
    public function it_should_create_new_string_type_and_verify_the_invoked_value()
    {
        $stringType = new StringType('string');
        $this->assertEquals('string', $stringType());
        $this->assertTrue('string' === $stringType());
    }

    /**
     * @test
     */
    public function it_should_create_new_string_type_from_alias()
    {
        $alias = new StringTypeAlias('alias');
        $this->assertEquals('alias', $alias());
        $this->assertTrue('alias' === $alias());
    }
}

class StringTypeAlias extends StringType {}
