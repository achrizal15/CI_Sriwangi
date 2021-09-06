<?php
class BiayaUmum extends CI_Controller
{
    private $user = [];
    public function __construct()
    {
        parent::__construct();
        check_login_admin_session();
        $this->user = $this->db->get_where("users", ['email' => $this->session->userdata("email")])->row();
        $this->load->library("form_validation");
        $this->load->model("Biayaumum_models", "mbiayaumum");
    }
    public function index()
    {
        $this->form_validation->set_rules('namebiayaumum', 'Biaya Umum', 'required|trim');
        $this->form_validation->set_rules('saldobiayaumum', 'Saldo', 'required|trim|numeric');
        $this->form_validation->set_rules('rincianbiayaumum', 'Rincian', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Biaya Umum";
            $data['user'] = $this->user;
            $data['biayaumum'] = $this->mbiayaumum->get_biayaUmum();
            $this->load->view("templates/admin/header", $data);
            $this->load->view("admin/biayaumum_view", $data);
            $this->load->view("templates/admin/footer");
        } else {
            if ($this->input->post("submit") == "tambahbiayaumum") {
                $this->tambahData();
            } else {
                $this->editData();
            }
        }
    }
    private function tambahData()
    {
        $data = [
            null,
            htmlspecialchars(ucwords($this->input->post('namebiayaumum', true))),
            $this->input->post('saldobiayaumum'),
            htmlspecialchars(ucfirst($this->input->post('rincianbiayaumum'))),
            time(),
        ];
        if ($this->mbiayaumum->tambahData($data) > 0) {
            alertmessage(true, 'tambah data biaya umum');
            redirect('BiayaUmum');
        } else {
            alertmessage(false, 'tambah data biaya umum');
            redirect('BiayaUmum');
        }
    }
    private function editData()
    {
        $id=$this->input->post("editID");
        $data = [
            "biayaumum_name" =>  htmlspecialchars(ucwords($this->input->post('namebiayaumum', true))),
            "biayaumum_saldo" =>  $this->input->post('saldobiayaumum'),
            "biayaumum_rincian" => htmlspecialchars(ucfirst($this->input->post('rincianbiayaumum'))),
            "biayaumum_date" => $this->input->post('editDate')
        ];
     if($this->mbiayaumum->editDataBiayaUmum($id,$data)>0){
         alertmessage(true,'data biaya umum dirubah');
         redirect('BiayaUmum');
     }else{
         alertmessage(false,'data biaya umum dirubah');
         redirect('BiayaUmum');
     }
    }
    public function deleteData($id)
    {
        if ($this->mbiayaumum->deleteDataBiayaUmum($id) > 0) {
            alertmessage(true, "delete data biaya umum");
            redirect('BiayaUmum');
        } else {
            alertmessage(false, "delete data biaya umum");
            redirect('BiayaUmum');
        }
    }
    public function getEdit()
    {
        $id = $this->input->post('id');
        $data = json_encode($this->mbiayaumum->get_biayaUmum($id));
        echo $data;
    }
}
