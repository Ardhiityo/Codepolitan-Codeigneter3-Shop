<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
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

        $data['title'] = 'Order';
        $data['keyword'] = $keyword;
        $data['page'] = 'pages/order/index';
        $data['per_page'] = $this->order->per_page;
        $data['current_page'] = $page;
        $data['content'] = $this->order->like('invoice', $keyword)->paginate($keyword ? 1 : $page)->get();
        $data['total_rows'] = $this->order->where('invoice', $keyword)->count();
        $data['pagination'] = $this->order->makePagination(base_url('order'), $data['total_rows'], 2);

        $this->view($data);
    }

    public function detail($invoice = null)
    {
        if (is_null($invoice)) {
            $this->session->set_flashdata('warning', 'Order not found');
            redirect('/order');
        }

        $order = $this->order->where('invoice', $invoice)->first();

        if (is_null($order)) {
            $this->session->set_flashdata('warning', 'Order not found');
            redirect('/order');
        }

        if (! $this->order->validate()) {
            $data['title'] = 'Order Detail';
            $data['page'] = 'pages/order/detail';
            $data['order'] = $order;
            $this->order->table = 'order_detail';
            $data['order_detail'] = $this->order->
                select([
                    'product.title',
                    'product.image_url',
                    'product.price',
                    'order_detail.quantity',
                    'order_detail.subtotal'
                ])
                ->join('product')
                ->get();

            if ($order->status != 'waiting') {
                $this->order->table = 'order_confirm';
                $data['order_confirm'] = $this->order->where('order_id', $order->id)->first();
            }

            $this->view($data);
            return;
        }

        $status = $this->input->post('status', true);
        
        $this->order->where('id', $order->id)->update([
            'status' => $status
        ]);
        
        $this->session->set_flashdata('success', 'Order updated status successfully');
        redirect('order');
    }
}
