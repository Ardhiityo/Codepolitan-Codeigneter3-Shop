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
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        } else {
            $input = (object) $this->checkout->getDefaultValues();
        }

        if (! $this->checkout->validate()) {
            $data['title'] = 'Checkout';
            $data['page'] = 'pages/checkout/index';
            $data['input'] = $input;
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
            return;
        }

        $this->checkout->table = 'cart';
        $cart = $this->checkout
            ->select([
                'product.price',
                'cart.product_id',
                'cart.quantity',
                'cart.subtotal'
            ])
            ->where('cart.user_id', $this->user_id)
            ->join('product')
            ->get();

        $this->db->trans_start();
        
        $this->checkout->table = 'order';
        $order_id = $this->checkout->create([
            'user_id' => $this->user_id,
            'invoice' => 'INV-'.time(),
            'address' => $input->address,
            'phone' => $input->phone,
            'status' => 'waiting',
            'date' => date("Y-m-d H:i:s"),
            'total' => array_sum(array_column($cart, 'subtotal')),
            'name' => $input->name
        ]);

        if (! $order_id) {
            $this->session->set_flashdata('error', 'Failed to create the order');
            redirect('/cart');
        }

        $this->checkout->table = 'order_detail';
        foreach ($cart as $row) {
            $this->checkout->create([
                'order_id' => $order_id,
                'product_id' => $row->product_id,
                'quantity' => $row->quantity,
                'subtotal' => $row->subtotal
            ]);
        }

        $this->checkout->table = 'cart';
        $this->checkout->where('user_id', $this->user_id)->delete();
        
        $this->db->trans_complete();

        $this->session->set_flashdata('success', 'Checkout created successfully');
        redirect('/checkout/success');
    }
}
