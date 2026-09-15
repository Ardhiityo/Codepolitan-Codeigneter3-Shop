<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{
    protected $table = 'user';
    public $per_page = 5;

    public function getDefaultValues()
    {
        return [
            'name' => '',
            'email' => '',
            'password' => '',
            'role' => '',
            'is_active' => true
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
                'errors' => [
                    'is_unique' => 'This %s already exists.'
                ]
            ],
            [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'is_active',
                'label' => 'Is Active',
                'rules' => 'trim|required'
            ]
        ];
    }

}