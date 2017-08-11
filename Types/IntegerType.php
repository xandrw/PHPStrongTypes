<?php

require_once __DIR__ . '/../Type.php';

class IntegerType extends Type
{
    public static function parseInt($number)
    {
        $number = ($number instanceof Type) ? $number() : $number;

        if (! is_numeric($number))
            throw new InvalidArgumentException('You must specify a numeric value.');
        return new self((int) $number);
    }
}
