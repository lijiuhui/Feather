<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/12
 * Time: 11:51
 */

namespace Feather;

use Feather\Core\Request;

defined('CORE_PATH') or define('CORE_PATH', __DIR__);


class Feather
{
    // 配置项
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        spl_autoload_register(array($this, 'loadCoreClass'));
        $this->setReporting();
        $this->route();
    }

    /**
     * 自动加载类
     * @param $class_name
     */
    public function loadCoreClass($class_name)
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

    private function setReporting()
    {
        if(APP_DEBUG == true)
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        }
        else
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }

    private function route()
    {
        $module_name = $this->config['defaultModule'];
        $action_name = $this->config['defaultAction'];
        $url = $_SERVER['REQUEST_URI'];

        // 清除 ? 之后的数据
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        // 清除首末的 /
        $url = trim($url, '/');

        if($url)
        {
            $uris = explode('/', $url);

            // 去除为空的元素
            $uris = array_filter($uris);
            $module_name = ucfirst($uris[0]);

            array_shift($uris);
        }

        $action = $module_name . '\\' . $action_name;
        if(!class_exists($action))
        {
            exit($action . '不存在');
        }

        // 实例化Request
        $request = new Request();
        // 实例化具体action
        $dispatch = new $action();

        // 调用process处理方法
        call_user_func_array(array($dispatch, 'process'), array($request));
    }
}