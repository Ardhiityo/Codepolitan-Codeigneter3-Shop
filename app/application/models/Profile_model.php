<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends MY_Model
{
    protected $table = 'user';

    public function getDefaultValues()
    {
        return [
            'email' => '',
            'password' => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_unique_email',
            ],
        ];
    }
}
