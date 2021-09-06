<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    private  $user = [];
    public function __construct()
    {
        parent::__construct();
        check_login_admin_session();
        $this->user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->load->model("Product_models", "mproduct");
        $this->load->library("form_validation");
    }
    public function index()
    {
        $this->form_validation->set_rules("inputnamaproduk", "Product", "required|trim");
        $this->form_validation->set_rules("inputhargaproduk", "Harga", "required|numeric|trim|max_length[8]");
        $this->form_validation->set_rules("inputhargabeliproduk", "Harga Beli", "required|numeric|trim|max_length[8]|greater_than_equal_to[1]");
        $this->form_validation->set_rules("inputcategoryproduk", "Category", "required");
        $this->form_validation->set_rules("inputstokproduk", "Stock", "required|numeric|max_length[4]");
        $this->form_validation->set_rules("inputsatuanproduk", "Satuan", "required");

        if (!$this->form_validation->run()) {
            $data['title'] = "Product";
            $data['user'] = $this->user;
            $data['produk'] = $this->mproduct->getallProduct();
            $data['category'] = $this->db->get("category")->result_array();
            $data['satuan'] = $this->db->get("satuan")->result_array();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('admin/product', $data);
            $this->load->view('templates/admin/footer');
        } else {
            if ($this->input->post("submit") == "tambahproduk") {
                $this->tambahProduct();
            } else {
                $this->editProduct();
            }
        }
    }
    private function editProduct()
    {
        $image = $_FILES['inputgambarproduct']['name'];
        $oldImg = $this->input->post('oldgambar');
        if ($image) {
            $config['upload_path']          = './assets/img/product/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('inputgambarproduct')) {
                unlink(FCPATH . "assets/img/product/" . $oldImg);
                $newImage = $this->upload->data("file_name");
            }
        } else {
            $newImage = $oldImg;
        }
        $data = [
            "product_name" => htmlspecialchars(ucwords($this->input->post("inputnamaproduk"))),
            "category_id" => $this->input->post("inputcategoryproduk"),
            "product_harga_jual" => htmlspecialchars($this->input->post("inputhargaproduk")),
            "product_harga_beli" => htmlspecialchars($this->input->post("inputhargabeliproduk")),
            "product_stock" => htmlspecialchars($this->input->post("inputstokproduk")),
            "product_image" => $newImage,
            "satuan_id" => htmlspecialchars($this->input->post("inputsatuanproduk")),
            "product_date" => $this->input->post("createproduct"),
            "product_active" => 1
        ];
        if ($this->mproduct->editProduct($this->input->post("idproduct"), $data) > 0) {
            alertmessage(true, "produk berhasil di update");
        } else {
            alertmessage(false, "produk gagal di update");
        }
        redirect('product');
    }
    private function tambahProduct()
    {
        $image = $_FILES['inputgambarproduct']['name'];
        $newImage = "default.jpg";
        if ($image) {
            $config['upload_path']          = './assets/img/product/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('inputgambarproduct')) {
                $newImage = $this->upload->data('file_name');
            } else {
                alertmessage(true, $this->upload->display_errors());
            }
        }
        $data = [
            "product_id" => null,
            "product_name" => htmlspecialchars(ucwords($this->input->post("inputnamaproduk"))),
            "category_id" => $this->input->post("inputcategoryproduk"),
            "product_harga_jual" => htmlspecialchars($this->input->post("inputhargaproduk")),
            "product_harga_beli" => htmlspecialchars($this->input->post("inputhargabeliproduk")),
            "product_stock" => htmlspecialchars($this->input->post("inputstokproduk")),
            "product_image" => $newImage,
            "satuan_id" => htmlspecialchars($this->input->post("inputsatuanproduk")),
            "product_date" => time(),
            "product_active" => 1
        ];
        $this->db->insert("product", $data);
        $idLst = $this->db->insert_id();
        $this->db->insert('pengeluaran', ["product_id" => $idLst, 'pengeluaran_rincian' => 'Pembelanjaan product', "pengeluaran_date" => time()]);
        if ($newImage === "default.jpg") {
            alertmessage(true, "Berhasil menambah produk tetapi dengan gambar default");
        } else {
            alertmessage(true, "Berhasil menambah produk");
        }
        redirect("product");
    }
    public function deleteProduct($id)
    {
        $img = $this->db->query("SELECT product_image FROM product WHERE product_id=?", [$id])->row();
        if ($this->mproduct->deleteRow($id) != 0) {
            unlink(FCPATH . "assets/img/product/" . $img->product_image);
            alertmessage(true, "hapus produk");
            redirect("product");
        } else {
            alertmessage(false, "hapus produk");
            redirect("product");
        }
    }
    public function get_edit_product()
    {
        $id = $this->input->post("id");
        $data = [
            "product" => $this->mproduct->getallProduct($id),
            "category" => $this->db->get("category")->result(),
            "satuan" => $this->db->get("satuan")->result(),
        ];
        echo json_encode($data);
    }
}
