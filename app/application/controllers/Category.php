<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect('/');
        }
    }

    public function index($page = 1)
    {
        $keyword = $this->input->get('keyword', true);

        $data['title'] = 'Category';
        $data['page'] = 'pages/category/index';
        $data['content'] = $this->category->like('title', $keyword)->paginate($keyword ? 1 : $page)->get();
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
            redirect('category');
        } else {
            $this->session->set_flashdata('error', 'Ups, something went wrong');
            redirect('category/create');
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
                redirect('/');
            }
            $input = (object) $category;
        }

        if (! $this->category->validate()) {
            $data['title'] = 'Edit Category';
            $data['input'] = $input;
            $data['page'] = 'pages/category/form';

            $this->view($data);
        }

        $this->category->where('id', $id)->update($input);
        $this->session->set_flashdata('success', 'Category updated sucessfully');
        redirect('category');
    }

    public function delete($id)
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('category');
        }

        if ($this->category->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Category success deleted');
            redirect('category');
        } else {
            $this->session->set_flashdata('warning', 'Category not found');
        }
        redirect('category');
    }

    public function unique_slug($slug)
    {
        $category = $this->category->where('slug', $slug)->first();
        $path = $this->uri->segment(2);
        $id = $this->uri->segment(3);

        if ($id && $path === 'edit' && $category) {
            if ($id === $category->id) {
                return true;
            }
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }

        if ($category) {
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }

        return true;
    }
}
