<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controllername extends CI_Controller
{
    public function __construct()
    {
        $model = strtolower(get_class($this));
        if (file_exists(APPPATH.'models/'.$model.'_model.php')) {
            $this->load->model($model. '_model', $model);
        }
    }

    public function view($data)
    {
        $this->load->view('layouts/app', $data);
    }
}