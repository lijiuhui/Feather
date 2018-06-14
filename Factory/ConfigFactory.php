<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/14
 * Time: 16:33
 */

namespace Feather\Factory;


use Feather\Core\Config;

class ConfigFactory
{
    private static $config = null;

    public static function instance() : Config
    {
        if(self::$config !== null)
        {
            return self::$config;
        }

        self::$config = new Config();
        return self::$config;
    }
}