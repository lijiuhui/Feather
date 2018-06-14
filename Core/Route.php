<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/14
 * Time: 16:15
 */

namespace Feather\Core;


use Feather\Factory\ConfigFactory;

class Route
{
    public static function route() : string
    {
        $config = ConfigFactory::instance();
        $module_name = $config->APP(FeatherConst::$DEFAULT_MODULE_NAME);
        $action_name = $config->APP(FeatherConst::$DEFAULT_ACTION_NAME);

        $url = Route::clear($_SERVER['REQUEST_URI']);
        if($url)
        {
            $uris = array_filter(explode('/', $url));
            $module_name = ucfirst($uris[0]);
            $action_name = ucfirst($uris[1]);
        }

        $action = sprintf("%s\\%s", $module_name, $action_name);
        if(!class_exists($action))
        {
            throw new \Exception($action . '不存在');
        }

        return $action;
    }

    protected static function clear(string $url) : string
    {
        $position = strpos($url, '?');
        $result = $position === false ? $url : substr($url, 0, $position);
        return trim($result, '/');
    }
}