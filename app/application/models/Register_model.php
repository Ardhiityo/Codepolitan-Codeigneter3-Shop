<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends MY_Model
{
    protected $table = 'users';

    public function getDefaultValues()
    {
        return [
            'name' => '',
            'email' => '',
            'password' => '',
            'role' => '',
            'is_active' => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'This %s already exists.'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[5]|'
            ],
            [
                'field' => 'password_confirmation',
                'label' => 'Password Confirmation',
                'rules' => 'required|min_length[5]|matches[password]',
            ],
        ];
    }

    public function run($input)
    {
        $data = [
            'name' => $input->name,
            'email' => strtolower($input->email),
            'password' => hashPassword($input->password),
        ];

        $id = $this->create($data);

        $sess_user = [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'is_login' => true
        ];

        $this->session->set_userdata($sess_user);
        
        return true;
    }

}

/* End of file ModelName.php */
