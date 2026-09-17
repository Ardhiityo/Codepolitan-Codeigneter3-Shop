<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder_model extends MY_Model
{
    public $table = 'order';
    public $per_page = 5;

    public function getDefaultValues()
    {
        // 
    }

    public function getValidationRules()
    {
        // 
    }
}
