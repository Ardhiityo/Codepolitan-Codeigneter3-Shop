<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
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

        $data['keyword'] = $keyword;
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
        ])
            ->join('category')
            ->like('product.title', $keyword)
            ->orderBy('id', 'desc')
            ->paginate($keyword ? 1 : $page)
            ->get();

        $data['action'] = base_url('product');
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
            redirect('product/create');
        }

        $file_upload = fileUpload('image_url', './uploads/products');
        if (! $file_upload) {
            redirect('product');
        }

        $input->image_url = 'uploads/products/'.$file_upload['file_name'];
        if ($this->product->create($input)) {
            $this->session->set_flashdata('success', 'Product created successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('product');
    }

    public function edit($id)
    {
        $product = $this->product->where('id', $id)->first();
        if (is_null($product)) {
            $this->session->set_flashdata('warning', 'Product not found');
            redirect('product');
        }

        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        } else {
            $input = $product;
        }

        if (! $this->product->validate()) {
            $data['title'] = 'Edit Product';
            $data['input'] = $input;
            $data['page'] = 'pages/product/form';

            $this->view($data);
            return;
        }

        if ($_FILES['image_url']['name']) {
            $file_upload = fileUpload('image_url', './uploads/products');
            if (! $file_upload) {
                redirect('product');
            }
            if (file_exists($product->image_url)) {
                unlink($product->image_url);
            }
            $input['image_url'] = 'uploads/products/'.$file_upload['file_name'];
        } else {
            $input->image_url = $product->image_url;
        }

        $this->product->where('id', $product->id)->update($input);
        $this->session->set_flashdata('success', 'Product updated successfully');
        redirect('product');
    }

    public function delete($id)
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('product');
        }

        $product = $this->product->where('id', $id)->first();

        if (is_null($product)) {
            $this->session->set_flashdata('error', 'Product not found');
            redirect('product');
        }

        if (file_exists($product->image_url)) {
            unlink($product->image_url);
        }

        if ($this->product->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Product deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('product');
    }

    public function unique_slug($slug)
    {
        $product = $this->product->where('slug', $slug)->first();
        $path = $this->uri->segment(2);
        $id = $this->uri->segment(3);

        if ($id && $path === 'edit' && $product) {
            if ($id === $product->id) {
                return true;
            }
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }

        if ($product) {
            $this->form_validation->set_message('unique_slug', 'The {field} already exists');
            return false;
        }

        return true;
    }
}