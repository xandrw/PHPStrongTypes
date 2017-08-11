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
        if (! in_array($type, self::$types))
            throw new InvalidArgumentException("Invalid type given `{$type}`.");
    }
    
    final private static function checkDuplicateAliasType($alias)
    {
        foreach (self::$aliases as $type => $aliases) {
            if (is_array($aliases) && in_array($alias, $aliases))
                throw new InvalidArgumentException("The {$alias} alias is already set.");
        }
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
