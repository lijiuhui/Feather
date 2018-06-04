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

    public function __construct()
    {
        $this->view = new View();
        $this->data = new Domains\RequestData();
        $this->parse_data();
    }

    public function assign(string $name, $data)
    {
        $this->view->assign($name, $data);
    }

    public function display(string $view_path)
    {
        $this->view->display($view_path);
    }

    private function parse_data()
    {
        $this->data->set_payloads($_GET);
        $this->data->set_form_datas($_POST);
        $this->data->set_files($_FILES);
        $this->data->set_servers($_SERVER);
    }
}