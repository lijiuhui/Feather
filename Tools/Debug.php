<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/15
 * Time: 8:10
 */

namespace Feather\Tools;


class Debug
{
    public static function reporting()
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
}