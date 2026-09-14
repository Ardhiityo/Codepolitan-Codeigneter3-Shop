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
        $data['per_page'] = $this->category->per_page;
        $data['current_page'] = $page;
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
            $input = (object) $this->input->post(null, true);
        } else {
            $input = (object) $this->category->getDefaultValues();
        }

        if (! $this->category->validate()) {
            $data['title'] = 'Create Category';
            $data['input'] = $input;
            $data['page'] = 'pages/category/form';

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

    public function edit($id)
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        } else {
            $category = $this->category->where('id', $id)->first();
            if (is_null($category)) {
                $this->session->set_flashdata('warning', 'Category not found');
                redirect(base_url());
                return;
            }
            $input = (object) $category;
        }

        if (! $this->category->validate()) {
            $data['title'] = 'Edit Category';
            $data['input'] = $input;
            $data['page'] = 'pages/category/form';

            $this->view($data);
            return;
        }

        $this->category->where('id', $id)->update($input);
        $this->session->set_flashdata('success', 'Category updated sucessfully');
        redirect(base_url('category'));
    }

    public function delete($id)
    {
        if ($this->category->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Category success deleted');
            redirect(base_url('category'));
        } else {
            $this->session->set_flashdata('warning', 'Category not found');
        }
        redirect(base_url('category'));
    }

    public function unique_slug($slug)
    {
        $query = $this->category->where('slug', $slug);
        $path = $this->uri->segment(2);
        $id = $this->uri->segment(3);

        if ($id && $path === 'edit') {
            if ($id === $query->first()->id) {
                return true;
            }
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }

        if ($query->first()) {
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }
        return true;
    }
}
