<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/15
 * Time: 8:42
 */

namespace Feather\Core;


class Url
{
    private static $instance = null;

    protected function __construct()
    {
    }

    public static function instance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function create(string $module, string $action, array $param)
    {
        $param_str = $this->parse_param($param);
        return sprintf("/%s/%s?%s", $module, $action, $param_str);
    }

    private function parse_param(array $param) : string
    {
        $result = [];
        foreach($param as $key => $value)
        {
            $result[] = $key . '=' . $value;
        }
        return implode('&', $result);
    }
}