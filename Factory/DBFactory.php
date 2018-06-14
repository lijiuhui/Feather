<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/14
 * Time: 15:48
 */

namespace Feather\Factory;


use Feather\Services\Repository;
use Feather\ServicesImpl\RepositoryImp;

class DBFactory
{
    private static $db = null;

    public static function instance() : Repository
    {
        if(self::$db !== null)
        {
            return self::$db;
        }

        self::$db = new RepositoryImp();
        return self::$db;
    }
}