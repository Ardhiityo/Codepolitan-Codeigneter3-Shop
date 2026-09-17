<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder extends MY_Controller
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

    public function index($page = 1)
    {
        $data['title'] = 'My Order';
        $data['page'] = 'pages/myorder/index';
        $data['content'] = $this->myorder->where('user_id', $this->user_id)
            ->orderBy('date', 'desc')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->myorder->where('user_id', $this->user_id)->count();
        $data['pagination'] = $this->myorder->makePagination(
            base_url('myorder'), $data['total_rows'], 2
        );

        $this->view($data);
    }

    public function detail($invoice = null)
    {
        if (! $invoice) {
            $this->session->set_flashdata('warning', 'Invoice not found');
            redirect('/myorder');
        }

        $order = $this->myorder->where('invoice', $invoice)->first();

        if (is_null($order)) {
            $this->session->set_flashdata('warning', 'Invoice not found');
            redirect('/myorder');
        }

        $data['title'] = 'Order Detail';
        $data['page'] = 'pages/myorder/detail';
        $data['order'] = $this->myorder->where('invoice', $invoice)->first();
        $this->myorder->table = 'order_detail';
        $data['order_detail'] = $this->myorder->where('order_id', $order->id)
            ->select([
                'product.image_url',
                'product.title',
                'product.price',
                'order_detail.quantity',
                'order_detail.subtotal'
            ])
            ->orderBy('price', 'asc')
            ->join('product')
            ->get();

        return $this->view($data);
    }
}
