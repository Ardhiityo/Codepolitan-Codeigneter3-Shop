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
}