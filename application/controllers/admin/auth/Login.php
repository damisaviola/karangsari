<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $max_attempts = 5;       
    private $lockout_time = 300;

    public function __construct() {
        parent::__construct();

        $this->load->model('Login_model', 'user');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function index() {
       $this->load->view('admin/auth/login-admin');
    }


      private function process_login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

     
        $attempts = $this->session->userdata('login_attempts') ?? 0;
        $last_attempt = $this->session->userdata('last_attempt') ?? 0;

        if ($attempts >= $this->max_attempts && (time() - $last_attempt) < $this->lockout_time) {
            $this->session->set_flashdata('error', 'Terlalu banyak percobaan login. Tunggu beberapa menit.');
            redirect('auth/login');
        }

        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan Password wajib diisi.');
            redirect('auth/login');
        }

        $user = $this->user->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
       
            $this->session->unset_userdata(['login_attempts', 'last_attempt']);

           
            $this->session->sess_regenerate(TRUE);

            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);

            redirect('dashboard');
        } else {
            $this->session->set_userdata('login_attempts', $attempts + 1);
            $this->session->set_userdata('last_attempt', time());

            $this->session->set_flashdata('error', 'Username atau Password salah.');
            redirect('auth/login');
        }
    }


      public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}

?>