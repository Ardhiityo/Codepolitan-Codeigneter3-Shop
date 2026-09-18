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
        $data['page'] = 'pages/order/index';
        $data['per_page'] = $this->order->per_page;
        $data['current_page'] = $page;
        $data['content'] = $this->order->like('invoice', $keyword)->paginate($keyword ? 1 : $page)->get();
        $data['total_rows'] = $this->order->where('invoice', $keyword)->count();
        $data['pagination'] = $this->order->makePagination(base_url('order'), $data['total_rows'], 2);
        
        $this->view($data);
    }

}
