<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->library('session');
      
    }

    public function index() {
       
        $this->load->view('user/auth/auth-login');
    }

    public function action_login()
{
    $this->form_validation->set_rules('login', 'Email/No HP', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">','</div>'));
        redirect('user/auth/login');
    } else {
        $login_input = $this->input->post('login', TRUE);
        $password    = $this->input->post('password', TRUE);
        $password_md5 = md5($password);

        if (filter_var($login_input, FILTER_VALIDATE_EMAIL)) {
            $login_hashed = md5($login_input);
            $user = $this->User_model->getUserByEmail($login_hashed);
        } else {
            $user = $this->User_model->getUserByPhone($login_input);
        }

        if ($user) {
            if ($user['password'] === $password_md5) {
               
                $this->session->set_userdata('user_id', $user['id_penghuni']);
                $this->session->set_userdata('user_email', $login_input); 
                $this->session->set_flashdata('success', '<div class="alert alert-success">Login berhasil!</div>');
                echo "berhasil"; 
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Password salah!</div>');
                echo "gagal1"; 
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Email atau Nomor HP tidak ditemukan!</div>');
            echo "gagal"; 
        }
    }
}


    public function login_whatsapp() {
        $this->load->view('user/auth/login-wa'); 
    }

    public function login_wa() {
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">','</div>'));
            redirect('user/auth/login/login_whatsapp');
        } else {
            $no_hp_input = trim($this->input->post('no_hp', TRUE));
            $no_hp_hashed = md5($no_hp_input);

            
            $user = $this->User_model->getUserByPhone($no_hp_hashed);

            if ($user) {
                $wa_number = $no_hp_input;
                $message = urlencode("Halo, saya ingin login ke akun saya.");
                redirect("https://wa.me/$wa_number?text=$message");
            } else {

                $this->session->set_flashdata('error', '<div class="alert alert-danger">Nomor HP tidak terdaftar!</div>');
                echo "gagal";
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('adminauth/login');
    }
    
}
