<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2017/12/15
 * Time: 17:56
 */

namespace Demo;

define('APP_PATH', __DIR__ . '/');
define('APP_DEBUG', true);

require('../feather.php');
$config = require(APP_PATH . '/Config/main.php');

$core = new Feather($config);
$core->run();