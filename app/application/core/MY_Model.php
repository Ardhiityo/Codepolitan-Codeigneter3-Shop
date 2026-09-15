<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Model extends CI_Model
{
    protected $table = '';
    protected $per_page = 5;

    public function __construct()
    {
        parent::__construct();

        if (! $this->table) {
            $this->table = strtolower(str_replace(
                '_model',
                '',
                get_class($this)
            ));
        }
    }

    abstract public function getDefaultValues();
    abstract public function getValidationRules();

    public function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(
            "<small class='form-text text-danger text-sm'>", "</small>"
        );

        $validationRules = $this->getValidationRules();

        $this->form_validation->set_rules($validationRules);

        return $this->form_validation->run();
    }

    public function select($columns)
    {
        $this->db->select($columns);
        return $this;
    }

    public function where($column, $value)
    {
        $this->db->where($column, $value);
        return $this;
    }

    public function like($column, $value)
    {
        $this->db->like($column, $value);
        return $this;
    }

    public function orLike($column, $value)
    {
        $this->db->or_like($column, $value);
        return $this;
    }

    public function join($table)
    {
        $this->db->join($table, "$table.id = $this->table.$table"."_id");
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->db->order_by($column, $direction);
        return $this;
    }

    public function first()
    {
        return $this->db->get($this->table)->row();
    }

    public function get()
    {
        return $this->db->get($this->table)->result();
    }

    public function count()
    {
        return $this->db->count_all_results($this->table);
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data)
    {
        $this->db->update($this->table, $data);
    }

    public function delete()
    {
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function paginate($page)
    {
        $this->db->limit(
            $this->per_page,
            ($page * $this->per_page) - $this->per_page
        );
        return $this;
    }

    public function makePagination($base_url, $total_rows, $uri_segment)
    {
        $this->load->library('pagination');

        $config = [
            'base_url' => $base_url,
            'total_rows' => $total_rows,
            'per_page' => $this->per_page,
            'uri_segment' => $uri_segment,
            'use_page_numbers' => true,

            'first_link' => false,
            'last_link' => false,

            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',

            'attributes' => ['class' => 'page-link'],

            'prev_link' => 'Previous',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'next_link' => 'Next',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active"> <span class="page-link" aria-current="page">',
            'cur_tag_close' => '</span></li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}
