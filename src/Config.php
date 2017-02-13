<?php

namespace PHPieces\ANZGateway;

class Config
{
    private static $baseDir = __DIR__."/../config/";
    private static $store = [];

    public static function load($path)
    {
        if (!self::loaded($path)) {
            self::loadToStore($path);
        }

        return self::loadFromStore($path);
    }

    public static function set($key, $val)
    {
        self::$store[$key] = $val;
    }

    private static function loadToStore($path)
    {
        $vars = explode(".", $path);
        $file = array_shift($vars);
        self::$store[$file] = include(self::$baseDir."{$file}.php");
    }

    private static function loadFromStore($path)
    {
        $vars = explode(".", $path);
        $file = array_shift($vars);
        $config = self::$store[$file];

        foreach ($vars as $var) {
            if (!is_array($config)) {
                return null;
            }
            if (!array_key_exists($var, $config)) {
                return null;
            }
            $config = $config[$var];
        }
        return $config;
    }

    private static function loaded($path)
    {
        $vars = explode(".", $path);
        $file = array_shift($vars);
        return isset(self::$store[$file]);
    }
}
