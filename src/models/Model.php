<?php

namespace PHPieces\ANZGateway\models;

use ReflectionClass;

class Model
{

    private static function getConstants() : array
    {
        $class = static::$fields;
        return array_flip((new ReflectionClass($class))->getConstants());
    }

    private static function getConstructorArguments(array $params, array $constants) : array
    {
        $arguments = [];
        foreach ($constants as $key => $val) {
            if (isset($params[$key])) {
                $arguments[$key] = $params[$key];
            }
        }
        return $arguments;
    }

    public static function create(array $params) : self
    {
        $reflector = new ReflectionClass(static::class);
        $constants = self::getConstants();
        $data = self::getConstructorArguments($params, $constants);
        return $reflector->newInstanceArgs($data);
    }

    public static function getFields() : array
    {
        $fields = (new ReflectionClass(static::$fields))->getConstants();

        $final = [];
        foreach ($fields as $label => $name) {
            $label = str_replace("_", " ", $label);
            $label = strtolower($label);
            $label = ucwords($label);
            $final[$label] = $name;
        }
        return $final;
    }
}
