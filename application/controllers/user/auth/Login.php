<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(['url', 'security']);
      
    }

    public function index() {

        if ($this->session->userdata('id_penghuni')) {
            redirect('user/dashboard');
        }
       
        $this->load->view('user/auth/auth-login');
    }

    public function login_action() 
    {
        if ($this->session->userdata('id_penghuni')) {
            redirect('user/dashboard'); 
            return;
        }

  
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_error_delimiters('<div class="invalid-feedback d-block">', '</div>');
    
    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', 'Isi email dan password.');
        redirect('user/auth/login');
        return;
    }

    $recaptcha = $this->input->post('g-recaptcha-response');
    if (empty($recaptcha)) {
        $this->session->set_flashdata('error','Silakan centang captcha terlebih dahulu.');
        redirect('user/auth/login');
        return;
    }

    $secretKey = "6LfMpNorAAAAABG4Z5bBxmgyp-DnpZQjLiRDF1WB"; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret'   => $secretKey,
        'response' => $recaptcha,
        'remoteip' => $this->input->ip_address()
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $verifyResponse = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($verifyResponse);

    if(!$responseData || !$responseData->success) {
        $this->session->set_flashdata('error','Captcha tidak valid, coba lagi.');
        redirect('user/auth/login');
        return;
    }


    $email_input    = $this->security->xss_clean($this->input->post('email', TRUE));
    $password_input = $this->security->xss_clean($this->input->post('password', TRUE));
    $ip_address     = $this->input->ip_address();

    $penghuni = $this->User_model->get_by_email($email_input);

    $max_attempts = 5;
    $lockout_time = 15 * 60; 

    if ($penghuni) {
        if ($penghuni->failed_attempts >= $max_attempts &&
            (time() - strtotime($penghuni->last_failed_attempt)) < $lockout_time) {
            
            $this->session->set_flashdata('error', 'Akun terkunci karena gagal login terlalu banyak. Tunggu 15 menit.');
            redirect('user/auth/login');
            return;
        }

        if ($penghuni->password === md5($password_input) && $penghuni->status === 'aktif') {
            $this->session->sess_regenerate(TRUE);

            $this->session->set_userdata([
                'id_penghuni' => $penghuni->id_penghuni,
                'nama'        => $penghuni->nama,
                'email'       => $email_input, 
                'no_hp'       => $penghuni->no_hp,
                'alamat'      => $penghuni->alamat,
                'status'      => $penghuni->status,
                'ip_login'    => $ip_address,
                'logged_in'   => TRUE
            ]);

            $this->User_model->reset_failed_attempt($penghuni->id_penghuni);
            $this->User_model->update_last_login($penghuni->id_penghuni, $ip_address);

            redirect('user/dashboard');
            return;
        } else {
            $this->User_model->set_failed_attempt($penghuni->id_penghuni);
        }
    }

    $this->session->set_flashdata('error', 'Email atau password salah.');
    redirect('user/auth/login');
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
            session_regenerate_id(true);
            redirect('user/auth/login');
    }
    
}
