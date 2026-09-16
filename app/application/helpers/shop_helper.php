<?php

function getDropdownList($table, $columns)
{
    $CI =& get_instance();

    $dropdown1 = ['' => '-- Select --'];

    $query = $CI->db->select($columns)->get($table);

    if ($query->num_rows() > 0) {
        $dropdown2 = array_column($query->result_array(), $columns[1], $columns[0]);
        return $dropdown1 + $dropdown2;
    }

    return $dropdown1;
}

function getCategories()
{
    $CI =& get_instance();
    return $CI->db->get('category')->result();
}

function getCart()
{
    $CI =& get_instance();
    $user_id = $CI->session->userdata('id');

    if ($user_id) {
        return $CI->db->where('user_id', $user_id)->count_all_results('carts');
    }

    return false;
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function hashVerify($password, $hash)
{
    return password_verify($password, $hash);
}

function fileUpload($field, $upload_path)
{
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = 200;
    $config['file_name'] = uniqid();

    $CI =& get_instance();

    $CI->load->library('upload', $config);

    if (! $CI->upload->do_upload($field)) {
        $CI->session->set_flashdata('error', $CI->upload->display_errors());
        return false;
    } else {
        return $CI->upload->data();
    }
}