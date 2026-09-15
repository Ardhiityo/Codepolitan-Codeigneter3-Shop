<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model
{
    protected $table = 'user';

    public function getDefaultValues()
    {
        return [
            'email' => '',
            'password' => '',
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
        ];
    }

    public function run($input)
    {
        $user = $this->where('email', strtolower($input->email))->where('is_active', true)->first();

        if (! is_null($user) && hashVerify($input->password, $user->password)) {
            $sess_data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'is_login' => true
            ];
            $this->session->set_userdata($sess_data);

            return true;
        }

        return false;
    }
}
