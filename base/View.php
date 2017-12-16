<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/15
 * Time: 17:43
 */

namespace Feather\Base;
defined('VIEW_PATH') or define('VIEW_PATH', str_replace("\\", '/',APP_PATH) . '/Views/');

class View
{
    protected $variables = array();

    public function __construct()
    {

    }

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function display($view)
    {
        extract($this->variables);
        $view = VIEW_PATH . $view;
        if(!is_file($view))
        {
            exit("视图文件" . $view . "不存在");
        }
        include $view;
    }
}