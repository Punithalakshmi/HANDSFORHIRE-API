<?php
function getAdminUserId()
{
    $CI = & get_instance();
    $admin = $CI->session->userdata('admin_data');
    return isset($admin['id'])?$admin['id']:FALSE;
}

function get_product_sku($product_id) {
    $CI = & get_instance();
    $CI->load->model("product_model");
    $res = $CI->product_model->get_where(array("id" => $product_id),"sku")->row_array();
    return $res['sku'];
}

function get_vendor_name($vendor_id) {
    $CI = & get_instance();
    $CI->load->model("vendor_model");
    $res = $CI->vendor_model->get_where(array("id" => $vendor_id),"name")->row_array();
    return displayData($res['name'],"humanize");
}







?>