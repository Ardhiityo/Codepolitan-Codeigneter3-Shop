<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MY_Model
{
    protected $table = 'order';
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

/* End of file ModelName.php */
