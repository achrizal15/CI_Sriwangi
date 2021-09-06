<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('role_id') != null) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('Dashboard');
            } else {
                redirect('kasir');
            }
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth/footer');
        } else {
            // Tombol Login Di Pencet
            $this->_login();
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        redirect('auth');
    }
    private function _login()
    {
        $this->load->model('Auth_models');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user =  $this->Auth_models->getWhere($email);
        if ($user != null) {
            if ($user->is_active == 1) {
                if (password_verify($password, $user->password)) {
                    $data = [
                        'email' =>  $user->email,
                        'role_id' => $user->role_id,
                    ];
                    $this->session->set_userdata($data);
                    if ($user->role_id == 1) {
                        redirect('Dashboard');
                    } else {
                        echo "KASIR";
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                 Password tidak cocok dengan user!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email yang anda gunakan belum aktif!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Email yang anda gunakan belum terdaftar!</div>');
            redirect('auth');
        }
    }
    public function register()
    {
        if ($this->session->userdata('role_id') != null) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin/Dashboard');
            } else {
                redirect('kasir');
            }
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'matches[repassword]|required');
        $this->form_validation->set_rules('repassword', 'Repassword', 'matches[password]|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register Page';
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth/footer');
        } else {
            $data = [
                "id" => null,
                'name' => htmlspecialchars(ucwords($this->input->post('name', true))),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => "default.jpg",
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->load->model('Auth_models');
            if ($this->Auth_models->setUsers($data) == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil registrasi silahkan login!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Gagal melakukan registrasi silahkan coba lagi!</div>');
                redirect('auth');
            }
        }
    }
}
