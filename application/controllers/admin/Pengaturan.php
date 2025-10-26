<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct(); 

        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->Admin_model->getAdminById($id_admin);

        $this->load->view('admin/settings/header', $data);
        $this->load->view('admin/dashboard/sidebar', $data);
        $this->load->view('admin/settings/pengaturan', $data);
        $this->load->view('admin/settings/footer', $data);
    }

    public function tambah_kamar() {
        $id_admin = $this->session->userdata('id_admin');
        $data['admin'] = $this->Admin_model->getAdminById($id_admin);

 
        $this->load->view('admin/kamar/header', $data);
        $this->load->view('admin/dashboard/sidebar', $data);
        $this->load->view('admin/kamar/tambah_kamar', $data);
        $this->load->view('admin/kamar/footer', $data);
    }

  

     public function update_password() {
        $id_admin = $this->input->post('id_admin', true);
        $password_lama = $this->input->post('password_lama', true);
        $password_baru = $this->input->post('password_baru', true);
        $konfirmasi_password = $this->input->post('konfirmasi_password', true);

        $admin = $this->Admin_model->getAdminById($id_admin);

        if (!$admin) {
            $this->session->set_flashdata('error', 'Admin tidak ditemukan.');
            redirect('admin/pengaturan');
        }

        if (md5($password_lama) !== $admin->password) {
            $this->session->set_flashdata('error', 'Kata sandi lama salah.');
            redirect('admin/pengaturan');
        }

        if ($password_baru !== $konfirmasi_password) {
            $this->session->set_flashdata('error', 'Konfirmasi kata sandi baru tidak cocok.');
            redirect('admin/pengaturan');
        }

        $update = $this->Admin_model->updatePassword($id_admin, md5($password_baru));

        if ($update) {
            $this->session->set_flashdata('success', 'Kata sandi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui kata sandi.');
        }

        redirect('admin/pengaturan');
    }

            public function update_profile()
        {

            $id_admin = $this->input->post('id_admin', true);
            $nama_lengkap = $this->input->post('nama_lengkap', true);
            $username = $this->input->post('username', true);
            $no_hp = $this->input->post('no_hp', true);

            $admin = $this->Admin_model->getAdminById($id_admin);
            if (!$admin) {
                $this->session->set_flashdata('error', 'Admin tidak ditemukan.');
                redirect('admin/pengaturan');
            }

            $data = [
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'no_hp' => $no_hp
            ];

            $update = $this->Admin_model->updateProfile($id_admin, $data);

            if ($update) {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }

            redirect('admin/pengaturan');
        }

}


