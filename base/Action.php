<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/15
 * Time: 17:29
 */

namespace Feather\Base;
use Feather\BaseInterface\IAction;

class Action implements IAction
{
    protected $_view;
    public function __construct()
    {
        $this->_view = new View();
    }

    public function process()
    {
    }

    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    public function display($view)
    {
        $this->_view->display($view);
    }
}