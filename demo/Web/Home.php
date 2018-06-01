<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/15
 * Time: 18:05
 */

namespace Web;
use Feather\Core\Action;
use Components;

class Home extends Action
{

    public function process()
    {
        $this->display(Components\Views::$Home);
    }
}