<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $is_logged = $this->session->userdata('is_login');
        $user_id = $this->session->userdata('id');
        if (! $is_logged || ! $user_id) {
            redirect('login');
        }
        $this->user_id = $user_id;
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $data['page'] = 'pages/profile/index';
        $data['content'] = $this->profile->where('id', $this->user_id)->first();
        
        $this->view($data);
    }
}