<?php

abstract class Type
{
    private $value;
    private $type = null;
    private $types = ['boolean', 'integer', 'double', 'string', 'array', 'object'];
    
    final public function __construct($value)
    {
        $this->makeTypeFromClassName();
        $this->checkType();
        $this->checkValueType($value);
        $this->value = $value;
    }
    
    final private function makeTypeFromClassName()
    {
        $className = strtolower(static::class);
        $className = preg_replace('/(type)+$/', '', $className);

        $this->type = $className;
    }
    
    final private function checkType()
    {
        if (! in_array($this->type, $this->types) || $this->type === null)
            throw new InvalidArgumentException("Invalid type given `{$this->type}`.");
    }
    
    final private function checkValueType($value)
    {
        $type = gettype($value);
        if ($type !== $this->type)
            throw new InvalidArgumentException("Value must be `{$this->type}`, `{$type}` given.");
    }
    
    final public static function make($value)
    {
        return new static($value);
    }
    
    final public function __invoke()
    {
        return $this->value;
    }
    
    final public function __toString()
    {
        if (is_array($this->value) || is_object($this->value))
            return serialize($this->value);
        
        return (string) $this->value;
    }
}
