<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $has_session = $this->session->userdata('is_login');

        if ($has_session) {
            redirect('/');
        }
    }

    public function index()
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        }

        if (! $this->login->validate()) {
            $data['title'] = 'Login';
            $data['page'] = 'pages/auth/login';

            $this->view($data);
            return;
        }

        if ($this->login->run($input)) {
            $this->session->set_flashdata('success', 'Login successfully');
            redirect('/');
        } else {
            $this->session->set_flashdata('error', 'Email or Password is not valid or Account is deactived');
            redirect('login');
        }
    }

}
