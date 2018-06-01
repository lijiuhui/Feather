<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/1
 * Time: 15:22
 */

namespace Feather\Services;


interface Repository
{
    public function add(string $query);
    public function query(string $query);
    public function query_all(string $query);
}