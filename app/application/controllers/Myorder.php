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
            
        if($order->status != 'waiting') {
            $this->myorder->table = 'order_confirm';
            $data['order_confirm'] = $this->myorder->where('order_id', $order->id)->first();
        }

        return $this->view($data);
    }

    public function confirm()
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        }

        if (! $this->myorder->validate()) {
            $data['title'] = 'Order Confirm';
            $data['page'] = 'pages/myorder/confirm';
            $data['content'] = $this->myorder->where('user_id', $this->user_id)->orderBy('id', 'desc')->first();

            $this->view($data);
            return;
        }

        $order = $this->myorder->where('invoice', $input->invoice)->first();

        if (is_null($order)) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('myorder/confirm');
        }
        
        if ($order->total != $input->nominal) {
            $this->session->set_flashdata('warning', 'Nominal does not match on your total order');
            redirect('myorder/confirm');
        }

        if (! $_FILES['image_url']['name']) {
            $this->session->set_flashdata('warning', 'Image field is required');
            redirect('myorder/confirm');
        }

        $file_upload = fileUpload('image_url', './uploads/proof');
        if (! $file_upload) {
            redirect('myorder/confirm');
        }

        $input->image_url = 'uploads/proof/'.$file_upload['file_name'];

        $data = [
            'order_id' => $order->id,
            'account_name' => $input->account_name,
            'account_number' => $input->account_number,
            'nominal' => $input->nominal,
            'note' => $input->note,
            'image_url' => $input->image_url
        ];

        $this->myorder->table = 'order_confirm';
        if ($this->myorder->create($data)) {
            $this->myorder->table = 'order';
            $this->myorder->where('id', $order->id)->update(['status' => 'paid']);
            $this->session->set_flashdata('success', 'Bukti transfer sukses dibuat');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }

        redirect('/myorder/detail/'.$order->invoice);
    }
}
