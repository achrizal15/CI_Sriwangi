<?php
class Pengeluaran extends CI_Controller
{
    private $user = [];
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->load->model("Pengeluaran_models", 'mpengeluaran');
    }
    private function totalPengeluaran()
    {
        $pengeluaran = $this->mpengeluaran->getAll();
        $p = [];
        $b = [];
        for ($i = 0; $i < count($pengeluaran); $i++) {
            $p[] = $pengeluaran[$i]['product_harga_beli'];
        }
        for ($i = 0; $i < count($pengeluaran); $i++) {
            $b[] = $pengeluaran[$i]['biayaumum_saldo'];
        }
        $total = array_sum($p) + array_sum($b);
        return  $total;
    }
    public function index()
    {
        $data['title'] = "Pengeluaran";
        $data['user'] = $this->user;
        $data['pengeluaran'] = $this->mpengeluaran->getAll();
        $data['totalPengeluaran']=$this->totalPengeluaran();
        $this->load->view('templates/admin/header', $data);
        $this->load->view('admin/pengeluaran_view', $data);
        $this->load->view('templates/admin/footer');
    }
}
