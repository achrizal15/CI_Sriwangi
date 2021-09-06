<?php
class ProductCategory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login_admin_session();
        $this->load->model("Category_models","mcategory");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('kategory', 'Category', 'required|trim|is_unique[category.category_name]');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Product Category";
            $data['user'] = $this->db->get_where('users', array('email' => $this->session->userdata('email')))->row();
            $data['category'] = $this->db->get("category")->result();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('admin/Product_category', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $data = [
                "category_id" => null,
                "category_name" => htmlspecialchars(ucwords($this->input->post('kategory', true)))
            ];
            $this->db->insert("category", $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Category ditambahkan!</div>');
            redirect("ProductCategory");
        }
    }
    public function hapusCategory()
    {
        $id = $this->input->post("id");

        if ($this->mcategory->checkProductCategory($id) == 1) {
            $error = [
                "error" => true,
                "message" => 'Data masih digunakan'
            ];
        } else {
            $this->db->delete("category", ['category_id' => $id]);
            $data = $this->db->get("category")->result_array();
            $error = [
                "error" => false,
                "message" => 'Tersedia',
                "data" => $data
            ];
        }
        echo json_encode($error);
    }
    public function getCategoryJson()
    {
        $id = $this->input->post("id");
        $category = $this->db->get_where("category", ["category_id" => $id])->row_array();
        echo json_encode($category);
    }
    public function editCategory()
    {
        $id = $this->input->post("id");
        $this->form_validation->set_rules('category1', 'Category', 'required|trim|is_unique[category.category_name]');
        if ($this->form_validation->run() == false) {
           alertmessage(false,"pastikan nama category tidak sama");
            redirect("ProductCategory");
        } else {
            $id = $this->input->post("id");
            $category =   $this->input->post("category1");

            $data = [
                "category_name" => htmlspecialchars(ucwords($category))
            ];
            $this->db->update("category", $data, ["category_id" => $id]);
            alertmessage(true,"category berhasil dirubah");
            redirect("ProductCategory");
        }
    }
}
