<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model
{
    protected $table = 'product';
    public $per_page = 2;

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
