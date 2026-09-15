<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model
{
    protected $table = 'product';
    public $per_page = 5;

    public function getDefaultValues()
    {
        return [
            'category_id' => '',
            'slug' => '',
            'title' => '',
            'desc' => '',
            'price' => '',
            'is_available' => '',
            'image_url' => '',
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'category_id',
                'label' => 'Category',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug'
            ],
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'desc',
                'label' => 'Description',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'is_available',
                'label' => 'Availability',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function fileUpload($field)
    {
        $config['upload_path'] = './uploads/products';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 200;
        $config['file_name'] = uniqid('product');

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload($field)) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            return false;
        } else {
           return $this->upload->data();
        }
    }
}
