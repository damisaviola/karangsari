<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_user extends CI_Controller {

    public function __construct() {
        parent::__construct(); 

        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('id_penghuni')) {
            redirect('user/auth/login');
        }
    }

    

     public function index() {
        $id_penghuni = $this->session->userdata('id_penghuni');
        $data['penghuni'] = $this->User_model->get_penghuni_by_id($id_penghuni);

        $this->load->view('user/pengaturan/header');
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/pengaturan/pengaturan', $data);
        $this->load->view('user/pengaturan/footer');
    }


     public function update_profile() 
{
    $id = $this->input->post('id_penghuni', true);

    $nama   = $this->input->post('nama', true);
    $no_hp  = $this->input->post('no_hp', true);
    $email  = $this->input->post('email', true);
    $alamat = $this->input->post('alamat', true);

    if (empty($nama) || empty($no_hp) || empty($email) || empty($alamat)) {
        $this->session->set_flashdata('error', 'Semua field wajib diisi.');
        redirect('user/pengaturan_user');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->session->set_flashdata('error', 'Format email tidak valid.');
        redirect('user/pengaturan_user');
    }

    if (!ctype_digit($no_hp)) {
        $this->session->set_flashdata('error', 'Nomor HP hanya boleh berisi angka.');
        redirect('user/pengaturan_user');
    }

    $data = [
        'nama'       => $nama,
        'no_hp'      => $no_hp,
        'email'      => $email,
        'alamat'     => $alamat,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($this->User_model->update($id, $data)) {
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
    } else {
        $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
    }

    redirect('user/pengaturan_user');
}



    public function update_password() {
    $id = $this->input->post('id_penghuni');
    $password_lama = $this->input->post('password_lama');
    $password_baru = $this->input->post('password_baru');
    $konfirmasi = $this->input->post('konfirmasi_password');

    $user = $this->User_model->get_penghuni_by_id($id);

    if ($password_lama !== $user->password) {
        $this->session->set_flashdata('error', 'Kata sandi lama tidak cocok.');
        redirect('user/pengaturan_user');
    }

    if ($password_baru !== $konfirmasi) {
        $this->session->set_flashdata('error', 'Konfirmasi kata sandi tidak cocok.');
        redirect('user/pengaturan_user');
    }

    $update = [
        'password' => $password_baru,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $this->User_model->update($id, $update);

    $this->session->set_flashdata('success', 'Kata sandi berhasil diubah.');
    redirect('user/pengaturan_user');
}


}