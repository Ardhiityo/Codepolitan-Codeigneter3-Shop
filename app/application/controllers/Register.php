<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $has_session = $this->session->userdata('is_login');

        if ($has_session) {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        }

        if (! $this->register->validate()) {
            $data['title'] = 'Register';
            $data['page'] = 'pages/auth/register';

            $this->view($data);
            return;
        }

        if ($this->register->run($input)) {
            $this->session->set_userdata('success', 'Register successfully');
            redirect(base_url());
            return;
        } else {
            $this->session->set_userdata('error', 'Ups, something went wrong');
            redirect(base_url('register'));
            return;
        }
    }

}

/* End of file Controllername.php */
