<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(['url', 'security']);
    }

    public function index() {
        $this->load->view('user/auth/auth-register');
    }

public function action_register()
    {
    
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

}

