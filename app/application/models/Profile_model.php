<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends MY_Model
{
    protected $table = 'user';

    public function getDefaultValues()
    {
        return [
            'name' => '',
            'email' => ''
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
                'rules' => 'trim|required|valid_email|callback_unique_email',
            ],
        ];
    }
}
