<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MY_Model
{
    public function getDefaultValues()
    {
        return [
            'name' => '',
            'address' => '',
            'phone' => ''
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
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'trim|required'
            ],
        ];
    }
}

/* End of file ModelName.php */
