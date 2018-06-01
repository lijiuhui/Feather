<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/1
 * Time: 16:00
 */

namespace Feather\Factory;
use PDO;

class PDOFactory
{
    private static $pdo = null;

    public static function instance() : PDO
    {
        if(self::$pdo !== null)
        {
            return self::$pdo;
        }

        $config = require APP_PATH . 'Config/main.php';
        $db_config = $config['DB'];
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $db_config['DB_HOST'], $db_config['DB_NAME']);
        self::$pdo = new PDO($dsn, $db_config['DB_USER'], $db_config['DB_PASSWD']);
        return self::$pdo;
    }
}