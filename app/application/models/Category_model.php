<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model
{
    protected $table = 'categories';
    
    public $per_page = 5;

    public function getDefaultValues()
    {
        return [
            'title' => '',
            'slug' => '',
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug',
            ],
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|required'
            ],
        ];
    }
}
