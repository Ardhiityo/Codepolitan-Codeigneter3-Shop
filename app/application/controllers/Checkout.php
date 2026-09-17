<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $has_session = $this->session->userdata('is_login');
        $user_id = $this->session->userdata('id');
        if (! $has_session || ! $user_id) {
            redirect('/login');
        }
        $this->user_id = $user_id;
    }

    public function index()
    {
        $data['title'] = 'Checkout';
        $data['page'] = 'pages/checkout/index';
        $data['content'] = $this->checkout
            ->select([
                'product.title',
                'product.price',
                'cart.quantity',
                'cart.subtotal'
            ])
            ->where('cart.user_id', $this->user_id)
            ->join('product')
            ->get();

        $this->view($data);
    }
}
