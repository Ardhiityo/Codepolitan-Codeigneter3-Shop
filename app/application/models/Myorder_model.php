<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder_model extends MY_Model
{
    public $table = 'order';

    public function getDefaultValues()
    {
        // 
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'account_name',
                'label' => 'Account Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'account_number',
                'label' => 'Account Number',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal',
                'rules' => 'trim|required|numeric|greater_than[0]'
            ],
            [
                'field' => 'note',
                'label' => 'Note',
                'rules' => 'trim|required'
            ],
        ];
    }
}
