<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('mail');
        $this->load->helper(['url', 'security']);
    }

    public function index() {
        $this->load->view('user/auth/auth-register');
    }

    public function verify_otp() {
        $this->load->view('user/auth/get-otp'); 
    }

    public function action_register(){
        
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[penghuni.email]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim|numeric');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">','</div>'));
                redirect('user/auth/register');
            } else {
                $nama     = $this->security->xss_clean($this->input->post('nama', TRUE));
                $email    = $this->security->xss_clean($this->input->post('email', TRUE));
                $alamat   = $this->security->xss_clean($this->input->post('alamat', TRUE));
                $telp     = $this->security->xss_clean($this->input->post('telp', TRUE));
                $password = $this->input->post('password', TRUE);


                $hash_nama   = md5($nama);
                $hash_email  = md5($email);
                $hash_alamat = md5($alamat);
                $hash_telp   = md5($telp);
                $hash_pass   = md5($password);

                $cek = $this->User_model->checkDuplicate($hash_email, $hash_telp);
                if ($cek) {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Nama atau Nomor Telepon sudah terdaftar.</div>');
                    redirect('user/auth/register');
                }

                $data = [
                    'nama'       => $hash_nama,
                    'no_hp'      => $hash_telp,
                    'email'      => $hash_email,
                    'password'   => $hash_pass,
                    'alamat'     => $hash_alamat,
                    'status'     => 'aktif',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($this->User_model->insertUser($data)) {
                    $this->session->set_flashdata('success', '<div class="alert alert-success">Pendaftaran berhasil! Silakan login.</div>');
                    echo "berhasil";
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Terjadi kesalahan, coba lagi.</div>');
                    echo "gagal";
                }
            }
        }

   public function action_register2() {

    // Validasi input form
    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    $this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim|numeric');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">','</div>'));
        redirect('user/auth/register');
        return;
    }

    // ===== CEK CAPTCHA =====
    $recaptcha = $this->input->post('g-recaptcha-response');
    if (empty($recaptcha)) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger">Silakan centang captcha terlebih dahulu.</div>');
        redirect('user/auth/register');
        return;
    }

    $secretKey = "6LfMpNorAAAAABG4Z5bBxmgyp-DnpZQjLiRDF1WB"; 
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="
        . $secretKey . "&response=" . $recaptcha . "&remoteip=" . $this->input->ip_address());
    $responseKeys = json_decode($response, true);

    if (!isset($responseKeys["success"]) || $responseKeys["success"] !== true) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger">Captcha tidak valid, coba lagi.</div>');
        redirect('user/auth/register');
        return;
    }

    $nama     = $this->security->xss_clean($this->input->post('nama', TRUE));
    $email    = $this->security->xss_clean($this->input->post('email', TRUE));
    $alamat   = $this->security->xss_clean($this->input->post('alamat', TRUE));
    $telp     = $this->security->xss_clean($this->input->post('telp', TRUE));
    $password = $this->input->post('password', TRUE);

    if ($this->User_model->existsByEmailOrPhone($email, $telp)) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger">Email atau Nomor Telepon sudah terdaftar.</div>');
        redirect('user/auth/register');
        return;
    }

    $otp = rand(1000, 9999);
    $expired_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

    $this->User_model->insertOtp([
        'email'      => $email,
        'otp'        => $otp,
        'status'     => 'pending',
        'created_at' => date('Y-m-d H:i:s'),
        'expired_at' => $expired_at
    ]);

    $subject = "Verifikasi OTP Registrasi Anda";
    $message = "Halo $nama,<br>OTP Anda: <b>$otp</b><br>OTP berlaku 5 menit.";
    $this->mail->send($email, $subject, $message);

    $this->session->set_userdata('register_temp', [
        'nama'     => $nama,
        'email'    => $email,
        'alamat'   => $alamat,
        'no_hp'    => $telp,
        'password' => $password
    ]);

    redirect('user/auth/register/verify_otp');
}



   public function action_verify_otp() {
    $otp_input = $this->input->post('otp', TRUE);
    $register_temp = $this->session->userdata('register_temp');

    if (!$register_temp) redirect('user/auth/register');

    if ($this->User_model->verifyOtp($register_temp['email'], $otp_input)) {
      
        $data = [
            'nama'       => md5($register_temp['nama']),
            'email'      => md5($register_temp['email']),
            'alamat'     => md5($register_temp['alamat']),
            'no_hp'      => md5($register_temp['no_hp']),
            'password'   => md5($register_temp['password']),
            'status'     => 'aktif',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->User_model->insertUser($data);
        $this->session->unset_userdata('register_temp');
        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
        redirect('user/auth/login');
    } else {
        $this->session->set_flashdata('error', 'OTP salah atau kadaluarsa!');
        redirect('user/auth/register/verify_otp');
    }
}
}
