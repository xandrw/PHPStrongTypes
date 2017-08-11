<?php

abstract class Type
{
    protected $value;
    protected $type = null;
    protected $types = ['boolean', 'integer', 'double', 'string', 'array', 'object'];
    
    final public function __construct($value)
    {
        $this->makeTypeFromClassName();
        $this->checkType();
        $this->checkValueType($value);
        $this->value = $value;
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

    final private function makeTypeFromClassName()
    {
        $className = preg_replace('/(type)+$/', '', $this->buildClassName());
        $this->type = $className;
    }

    final private function buildClassName()
    {
        $r = new ReflectionClass(static::class);
        $parentClassName = $r->getParentClass()->getName();

        if ($parentClassName && $parentClassName !== self::class)
            return strtolower($parentClassName);
        return strtolower(static::class);
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
}
