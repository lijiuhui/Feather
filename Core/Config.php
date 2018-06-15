<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/14
 * Time: 16:22
 */

namespace Feather\Core;

defined('CONF_PATH') or define('CONF_PATH', str_replace('\\', '/', APP_PATH) . '/Config/');

class Config
{
    private $app = [];
    private $db = [];
    private static $instance = null;

    protected function __construct()
    {
        $this->app = require CONF_PATH . 'main.php';
        $this->db = require CONF_PATH . 'db.php';
    }

    public static function instance() : Config
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function APP(string $key)
    {
        if(!$this->exists($this->app, $key)) return ConstString::$EMPTY;
        return $this->app[$key];
    }

    public function DB(string $key)
    {
        if(!$this->exists($this->db, $key)) return ConstString::$EMPTY;
        return $this->db[$key];
    }

    protected function exists($data, string $key) : bool
    {
        if(isset($data[$key]) || array_key_exists($key, $data))
            return true;
        return false;
    }
}