<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/4
 * Time: 10:17
 */

namespace Feather\Core;
use Feather\Domains;

class Request
{
    protected $method;
    protected $domain;
    private $view;
    private $data;
    private $globals = array('_POST', '_GET', '_FILES', '_SERVER');

    public function __construct()
    {
        $this->view = new View();
        $this->data = new Domains\RequestData();
        $this->init();
    }

    public function payloads() : array
    {
        return $this->data->get_payloads();
    }

    public function assign(string $name, $data)
    {
        $this->view->assign($name, $data);
    }

    public function display(string $view_path)
    {
        $this->view->display($view_path);
    }

    private function init()
    {
        $this->parse_data();
        $this->remove_globals();
    }

    private function parse_data()
    {
        $this->data->set_payloads($_GET);
        $this->data->set_form_datas($_POST);
        $this->data->set_files($_FILES);
        $this->data->set_servers($_SERVER);
    }

    /**
     * 移除已经转换的超全局变量
     */
    private function remove_globals()
    {
        foreach($this->globals as $item)
        {
            foreach($GLOBALS[$item] as $key => $value)
            {
                unset($GLOBALS[$key]);
            }
        }
    }
}