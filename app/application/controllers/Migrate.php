<?php

class Migrate extends CI_Controller
{
    public function index()
    {
        $this->load->library('migration');

        // $this->migration->version(1) = berdasarkan versi
        // $this->migration->latest() = generate semua table dari posisi latest migrations
        
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo 'MIGRATION SUCCESSFULLY';
        }
    }
}