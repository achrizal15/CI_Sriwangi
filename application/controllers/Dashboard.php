<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login_admin_session();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer');
    }
}
