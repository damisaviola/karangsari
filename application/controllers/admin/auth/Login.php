<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $max_attempts = 5;       
    private $lockout_time = 900; 

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'security', 'form']);
        $this->_set_security_headers();
    }

    private function _set_security_headers() {
        header("X-Frame-Options: SAMEORIGIN");
        header("X-Content-Type-Options: nosniff");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index() {
        if ($this->session->userdata('id_admin')) {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/auth/login-admin');
    }

    public function login_action() {
    if ($this->session->userdata('id_admin')) {
        redirect('admin/dashboard');
    }

    $this->form_validation->set_rules('username','Username','required|trim');
    $this->form_validation->set_rules('password','Password','required');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error','Isi username dan password.');
        redirect('admin/login');
        return;
    }

    $username   = $this->security->xss_clean($this->input->post('username', TRUE));
    $password   = $this->security->xss_clean($this->input->post('password', TRUE));
    $ip_address = $this->input->ip_address();

    $admin = $this->admin->get_by_username($username);

    if ($admin && $admin->status === 'aktif') {

        if ($admin->failed_attempts >= $this->max_attempts && 
            (time() - strtotime($admin->last_failed_attempt)) < $this->lockout_time) {
            
            $this->session->set_flashdata('error','Akun terkunci karena salah login berulang. Tunggu 15 menit.');
            redirect('admin/login');
            return;
        }

        if ($admin->password === md5($password)) {
            $this->admin->reset_failed_attempt($admin->id_admin);
            $this->session->sess_regenerate(TRUE);

            $this->session->set_userdata([
                'id_admin'     => $admin->id_admin,
                'username'     => $username,
                'nama_lengkap' => $admin->nama_lengkap,
                'role'         => $admin->role,
                'logged_in'    => TRUE,
                'is_admin'     => TRUE,
                'ip_address'   => $ip_address
            ]);

            $this->admin->update_last_login($admin->id_admin);

            redirect('admin/dashboard');
            return;
        } else {

            $this->admin->set_failed_attempt($admin->id_admin);
        }
    }

    $this->session->set_flashdata('error','Username atau password salah.');
    redirect('admin/login');
}


    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
