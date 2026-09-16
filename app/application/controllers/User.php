<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
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

        $data['keyword'] = $keyword;
        $data['title'] = 'User';
        $data['action'] = base_url('user');
        $data['page'] = 'pages/user/index';
        $data['per_page'] = $this->user->per_page;
        $data['current_page'] = $page;
        $data['content'] = $this->user->like('name', $keyword)
            ->orderBy('id', 'desc')
            ->paginate($keyword ? 1 : $page)
            ->get();
        $data['total_rows'] = $this->user->count();
        $data['pagination'] = $this->user->makePagination(
            base_url('user'), $data['total_rows'], 2
        );

        $this->view($data);
    }

    public function create()
    {
        if ($_POST) {
            $input = (object) $this->input->post(null, true);
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'password',
                'Password',
                'trim|required|min_length[5]'
            );
            $input->password = hashPassword($input->password);
        } else {
            $input = (object) $this->user->getDefaultValues();
        }

        if (! $this->user->validate()) {
            $data['title'] = 'Create User';
            $data['page'] = 'pages/user/form';
            $data['input'] = $input;

            $this->view($data);
            return;
        }

        if (! $_FILES['image_url']['name']) {
            $this->session->set_flashdata('warning', 'Image field is required');
            redirect('user/create');
        }

        $file_upload = fileUpload('image_url', './uploads/users');
        if (! $file_upload) {
            redirect('user');
        }

        $input->image_url = 'uploads/users/'.$file_upload['file_name'];

        if ($this->user->create($input)) {
            $this->session->set_flashdata('success', 'User created successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }

        redirect('user');
    }

    public function edit($id)
    {
        $user = $this->user->where('id', $id)->first();

        if (is_null($user)) {
            $this->session->set_flashdata('warning', 'User not found');
            redirect('user');
        }

        if ($_POST) {
            $input = (object) $this->input->post(null, true);
        } else {
            $input = $user;
        }

        if (! $this->user->validate()) {
            $data['title'] = 'Edit User';
            $data['page'] = 'pages/user/form';
            $data['input'] = $input;

            $this->view($data);
            return;
        }

        if ($_FILES['image_url']['name']) {
            $file_upload = fileUpload('image_url', './uploads/users');
            if (! $file_upload) {
                redirect('user');
            }
            if (file_exists($user->image_url)) {
                unlink($user->image_url);
            }
            $input->image_url = 'uploads/users/'.$file_upload['file_name'];
        } else {
            $input->image_url = $user->image_url;
        }

        if ($input->password) {
            $input->password = hashPassword($input->password);
        } else {
            $input->password = $user->password;
        }

        $this->user->where('id', $id)->update($input);
        $this->session->set_flashdata('success', 'User updated successfully');
        redirect('user');
    }

    public function delete($id)
    {
        if (! $_POST) {
            $this->session->set_flashdata('warning', 'Operation is not allowed');
            redirect('user');
        }

        $user = $this->user->where('id', $id)->first();

        if (is_null($user)) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('user');
        }

        if (file_exists($user->image_url)) {
            unlink($user->image_url);
        }

        if ($this->user->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('user');
    }

    public function unique_email($email)
    {
        $user = $this->user->where('email', $email)->first();
        $path = $this->uri->segment(2);
        $id = $this->uri->segment(3);

        if ($id && $path === 'edit' && $user) {
            if ($id === $user->id) {
                return true;
            }
            $this->form_validation->set_message('unique_email', 'The {field} already exists');
            return false;
        }

        if ($user) {
            $this->form_validation->set_message('unique_email', 'The {field} already exists');
            return false;
        }

        return true;
    }
}
