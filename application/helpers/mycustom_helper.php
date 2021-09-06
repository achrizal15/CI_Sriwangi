<?php

if (!function_exists("alertmessage")) {
    function alertmessage($kondisi, $message)
    {
        $CI = get_instance();
        $CI->load->library("session");
        if ($kondisi) {
            return  $CI->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Berhasil!</strong> ' . $message . '!<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span></button></div>');
        } else {
            return  $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal!</strong> ' . $message . '!<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span></button></div>');
        }
    }
}
if (!function_exists("check_login_admin_session")) {
    function check_login_admin_session()
    {
        $CI = get_instance();
        if ($CI->session->userdata('email') == null) {
            redirect('auth');
        }
        if ($CI->session->userdata('role_id') == 2) {
            redirect('kasir');
        }
    }
}
const PREFX = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
const SUFX = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
