<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/15
 * Time: 17:29
 */

namespace Feather\Core;

abstract class Action
{
    protected $_view;
    public function __construct()
    {
        $this->_view = new View();
    }

    abstract public function process(Request $request);

    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    public function display($view)
    {
        $this->_view->display($view);
    }
}