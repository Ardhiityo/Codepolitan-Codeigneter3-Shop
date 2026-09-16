<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $has_session = $this->session->userdata('is_login');

        if (! $has_session) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
