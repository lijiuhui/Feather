<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/12
 * Time: 11:51
 */

namespace Feather;

use Feather\Core\Request;
use Feather\Core\Route;
use Feather\Factory\DBFactory;
use Feather\Services\Repository;
use Feather\Tools\Debug;

defined('CORE_PATH') or define('CORE_PATH', __DIR__);


class Feather
{
    public static function run()
    {
        spl_autoload_register(array('Feather\Feather', 'loadCoreClass'));
        Debug::reporting();

        self::route();
    }

    private static function route()
    {
        $action_name = Route::route();
        $action = new $action_name();
        $request = new Request();

        // 调用实例化action的处理方法
        call_user_func(array($action, 'process'), $request);
    }

    /**
     * 自动加载类
     * @param $class_name
     */
    public static function loadCoreClass($class_name)
    {
        $file_dir = "";
        // 此类在框架中
        if(strpos($class_name, 'Feather') !== false)
        {
            $file_dir = str_replace("Feather", CORE_PATH, $class_name) . '.php';
        }
        else if(strpos($class_name, '\\') !== false)
        {
            $file_dir = APP_PATH . str_replace('\\', '/', $class_name) . '.php';
        }
        else
        {
            return ;
        }
        $file_dir = str_replace('\\', '/', $file_dir);
        if(!is_file($file_dir))
            return ;
        include $file_dir;
    }

    public static function DB() : Repository
    {
        return DBFactory::instance();
    }
}