<?php 
class KasirManagement extends CI_Controller 
{
   private $user=[];
    public function __construct()
    {
        parent::__construct();
        check_login_admin_session();
        $this->user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
    }
    public function index(){
        $data['title']="Kasir Management";
        $data['user']=$this->user;
        $this->load->view("templates/admin/header",$data);
        $this->load->view("admin/kasir_management");
        $this->load->view("templates/admin/footer");
    }
}
?>