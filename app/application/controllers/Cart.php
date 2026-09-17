<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $user_id = $this->session->userdata('id');
        if (! $is_login || ! $user_id) {
            redirect('login');
        }
        $this->user_id = $user_id;
    }

    public function index()
    {
        $data['title'] = 'Cart';
        $data['page'] = 'pages/cart/index';
        $data['content'] = $this->cart
            ->select([
                'product.title',
                'product.image_url',
                'product.price',
                'cart.product_id',
                'cart.quantity',
                'cart.subtotal'
            ])
            ->where('cart.user_id', $this->user_id)
            ->join('product')
            ->get();

        $this->view($data);
    }

    public function add()
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('/');
        }

        $request = (object) $this->input->post(null, true);

        if ($request->quantity < 1) {
            $this->session->set_flashdata('warning', 'Quantity must be greater than equal 1');
            redirect('/');
        }

        $cart_count = getCart();

        if ($cart_count > 100) {
            $this->session->set_flashdata('warning', 'The total in the cart has reached the maximum limit');
            redirect('/');
        }

        $this->cart->table = 'product';
        $product = $this->cart->where('id', $request->product_id)->first();

        if (is_null($product)) {
            $this->session->set_flashdata('warning', 'Product not found');
            redirect('/');
        }

        $this->cart->table = 'cart';
        $product_cart = $this->cart->where('product_id', $request->product_id)->where('user_id', $this->user_id)->first();

        if (is_null($product_cart)) {
            $this->cart->create([
                'user_id' => $this->user_id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'subtotal' => $product->price * $request->quantity
            ]);
        } else {
            $this->cart->where('product_id', $product->id)->where('user_id', $this->user_id)->update([
                'quantity' => $request->quantity + $product_cart->quantity,
                'subtotal' => $product_cart->subtotal + ($product->price * $request->quantity)
            ]);
        }

        $this->session->set_flashdata('success', 'Product added to cart successfully');
        redirect('/');
    }

    public function update()
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('cart');
        }

        $request = (object) $this->input->post(null, true);

        if ($request->quantity < 1) {
            $this->session->set_flashdata('warning', 'Quantity must be greater than equal 1');
            redirect('cart');
        }

        $this->cart->table = 'product';
        $product = $this->cart->where('id', $request->product_id)->first();

        $this->cart->table = 'cart';
        $product_cart = $this->cart->where('product_id', $request->product_id)->where('user_id', $this->user_id)->first();

        if (is_null($product) || is_null($product_cart)) {
            $this->session->set_flashdata('warning', 'Product not found');
            redirect('cart');
        }

        $this->cart->where('product_id', $product_cart->product_id)->where('user_id', $this->user_id)->update([
            'quantity' => $request->quantity,
            'subtotal' => $product->price * $request->quantity
        ]);

        $this->session->set_flashdata('success', 'Cart updated successfully');
        redirect('cart');
    }

    public function delete()
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('cart');
        }

        $request = (object) $this->input->post(null, true);

        $this->cart->table = 'product';
        $product = $this->cart->where('id', $request->product_id)->first();

        $this->cart->table = 'cart';
        $product_cart = $this->cart->where('product_id', $request->product_id)->where('user_id', $this->user_id)->first();

        if (is_null($product) || is_null($product_cart)) {
            $this->session->set_flashdata('warning', 'Product not found');
            redirect('cart');
        }

        if ($this->cart->where('product_id', $product_cart->product_id)->where('user_id', $this->user_id)->delete()) {
            $this->session->set_flashdata('success', 'Product cart deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('cart');
    }
}
