<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 1)
    {
        $data['title'] = 'Product';
        $data['page'] = 'pages/product/index';
        $data['total_rows'] = $this->product->count();
        $data['content'] = $this->product->select([
            'product.id',
            'product.image_url',
            'product.title AS product_title',
            'category.title AS category_title',
            'product.price',
            'product.is_available'
        ])->join('category')->paginate($page)->get();
        $data['per_page'] = $this->product->per_page;
        $data['current_page'] = $page;
        $data['pagination'] = $this->product->makePagination(
            base_url('product'),
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
            $input = (object) $this->product->getDefaultValues();
        }

        if (! $this->product->validate()) {
            $data['title'] = 'Create Product';
            $data['page'] = 'pages/product/form';
            $data['input'] = $input;
            $this->view($data);
            return;
        }

        if (! $_FILES['image_url']['name']) {
            $this->session->set_flashdata('warning', 'Image field is required');
            $data['title'] = 'Create Product';
            $data['page'] = 'pages/product/form';
            $data['input'] = $input;
            $this->view($data);
            return;
        }

        if ($file_upload = $this->product->fileUpload('image_url')) {
            $input->image_url = '/uploads/products/'.$file_upload['file_name'];
            if ($this->product->create($input)) {
                $this->session->set_flashdata('success', 'Product created successfully');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong');
            }
            redirect(base_url('product'));
        } else {
            $data['title'] = 'Create Product';
            $data['page'] = 'pages/product/form';
            $data['input'] = $input;
            $this->view($data);
            return;
        }
    }

    public function unique_slug($slug)
    {
        $query = $this->product->where('slug', $slug);
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