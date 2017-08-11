<?php

abstract class Type
{
    private $value;
    private $type = null;
    private static $types = ['boolean', 'integer', 'double', 'string', 'array', 'object'];
    private static $aliases = [];
    
    final public function __construct($value)
    {
        $this->makeTypeFromClassName();
        $this->checkType();
        $this->checkValueType($value);
        $this->value = $value;
    }
    
    final public static function make($value)
    {
        if (static::class === self::class)
            throw new InvalidArgumentException("Cannot call make on the abstract Type.");
        
        return new static($value);
    }
    
    final public static function alias($alias, $type)
    {
        $alias = strtolower($alias);
        self::checkAliasType($type);
        self::checkDuplicateAliasType($alias);
        self::$aliases[$type][] = $alias;
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
        $className = strtolower(static::class);
        $className = preg_replace('/(type)+$/', '', $className);
        $this->type = self::getAliasType($className);
    }
    
    final private static function getAliasType($alias)
    {
        foreach (self::$aliases as $type => $aliases)
            if (is_array($aliases) && in_array($alias, $aliases)) return $type;
        return $alias;
    }
    
    final private function checkType()
    {
        if (! in_array($this->type, self::$types) || $this->type === null)
            throw new InvalidArgumentException("Invalid type given `{$this->type}`.");
    }
    
    final private function checkValueType($value)
    {
        $type = gettype($value);
        if ($type !== $this->type)
            throw new InvalidArgumentException("Value must be `{$this->type}`, `{$type}` given.");
    }
    
    final private static function checkAliasType($type)
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
}
