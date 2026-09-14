<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 1)
    {
        $data['title'] = 'Category';
        $data['page'] = 'pages/category/index';
        $data['content'] = $this->category->paginate($page)->get();
        $data['total_rows'] = $this->category->count();
        $data['pagination'] = $this->category->makePagination(
            base_url('category'),
            $data['total_rows'],
            2
        );

        $this->view($data);
    }

}

/* End of file Controllername.php */
