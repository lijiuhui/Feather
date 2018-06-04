<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/4
 * Time: 19:16
 */

namespace Feather\Domains;

/**
 * Class RequestData
 * @package Feather\Domains
 * 上下文，收集get/post/files以及相关信息。
 * 供Action使用
 */
class RequestData
{
    /**
     * @var array
     * get数组转换后的数据
     */
    private $payloads = [];

    /**
     * @var array
     * post数组转换后的数据
     */
    private $form_datas = [];

    /**
     * @var array
     * fills数组转换后的数据
     */
    private $files = [];

    /**
     * @var array
     * servers数组转换后的数据
     */
    private $servers = [];

    public function __construct()
    {
        $this->payloads = [];
        $this->form_datas = [];
        $this->files = [];
        $this->servers = [];
    }

    public function set_payloads(array $data)
    {
        foreach($data as $key => $value)
        {
            $this->set_payload($key, $value);
        }
    }

    public function set_payload(string $name, $value)
    {
        $this->payloads[$name] = $value;
    }

    public function set_form_datas(array $data)
    {
        foreach($data as $key => $value)
        {
            $this->set_form_data($key, $value);
        }
    }

    public function set_form_data(string $key, $value)
    {
        $this->form_datas[$key] = $value;
    }

    public function set_files(array $data)
    {
        foreach($data as $key => $value)
        {
            $this->set_file($key, $value);
        }
    }

    public function set_file(string $key, $value)
    {
        $this->files[$key] = $value;
    }

    public function set_servers(array $data)
    {
        foreach($data as $key => $value)
        {
            $this->set_server($key, $value);
        }
    }

    public function set_server(string $key, $value)
    {
        $this->servers[$key] = $value;
    }

    public function get_payloads() : array
    {
        return $this->payloads;
    }
}