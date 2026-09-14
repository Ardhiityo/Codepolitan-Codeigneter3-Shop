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

    public function create()
    {
        if ($_POST) {
            $input = $this->input->post(null, true);
        }

        if (! $this->category->validate()) {
            $data['title'] = 'Create Category';
            $data['page'] = 'pages/category/create';

            $this->view($data);
            return;
        }

        $id = $this->category->create($input);

        if ($id) {
            $this->session->set_flashdata('success', 'Category created successfully');
            redirect(base_url('category'));
        } else {
            $this->session->set_flashdata('error', 'Ups, something went wrong');
            redirect(base_url('category/create'));
        }
    }

    public function unique_slug($str)
    {
        if ($this->category->where('slug', $str)->first()) {
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
