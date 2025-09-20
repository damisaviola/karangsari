<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
      
    }

    public function index() {
       
        $this->load->view('user/auth/auth-login');
    }

    public function login_action() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $admin = $this->Admin_model->get_by_username($username);

            if ($admin) {
                if ($admin->password === md5($password)) {
                    $session_data = [
                        'admin_id' => $admin->id_admin,
                        'username' => $admin->username,
                        'role'     => $admin->role,
                        'logged_in'=> TRUE
                    ];
                    $this->session->set_userdata($session_data);
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Password salah!');
                    redirect('adminauth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Username tidak ditemukan!');
                redirect('adminauth/login');
            }
        } else {
            $this->load->view('admin/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('adminauth/login');
    }
}
