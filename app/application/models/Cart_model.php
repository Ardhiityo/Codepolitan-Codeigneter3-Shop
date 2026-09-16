<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends MY_Model
{
    public $table = 'cart';
    public $per_page = 5;

    public function getDefaultValues()
    {
        return [
            // 
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'trim|required'
            ]
        ];
    }
}
