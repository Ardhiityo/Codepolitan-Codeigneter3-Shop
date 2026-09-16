<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();

        $is_logged = $this->session->userdata('is_login');
        $user_id = $this->session->userdata('id');
        if (! $is_logged || ! $user_id) {
            redirect('login');
        }

        $user = $this->profile->where('id', $user_id)->first();
        if (is_null($user)) {
            $this->session->set_flashdata('warning', 'User not found');
            redirect('profile');
        }
        $this->user = $user;
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $data['page'] = 'pages/profile/index';
        $data['content'] = $this->user;

        $this->view($data);
    }

    public function edit()
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        } else {
            $input = $this->user;
        }

        if (! $this->profile->validate()) {
            $data['title'] = 'Edit Profile';
            $data['page'] = 'pages/profile/form';
            $data['input'] = $input;

            $this->view($data);
            return;
        }

        if ($_FILES['image_url']['name']) {
            $file_upload = fileUpload('image_url', './uploads/users');
            if (! $file_upload) {
                redirect('profile');
            }
            if (file_exists($this->user->image_url)) {
                unlink($this->user->image_url);
            }
            $input->image_url = 'uploads/users/'.$file_upload['file_name'];
        } else {
            $input->image_url = $this->user->image_url;
        }

        if ($input->password) {
            $input->password = hashPassword($input->password);
        } else {
            $input->password = $this->user->password;
        }

        $this->profile->where('id', $this->user->id)->update($input);
        $this->session->set_flashdata('success', 'Profile updated successfully');
        redirect('profile');
    }

    public function unique_email($email)
    {
        $user = $this->profile->where('email', $email)->first();

        if ($user && $user->id != $this->user->id) {
            $this->form_validation->set_message('unique_email', 'The {field} already exists');
            return false;
        }

        return true;
    }
}