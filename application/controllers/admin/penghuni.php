<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Booking_model');
        $this->load->helper(['url', 'form']);
         if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['penghuni'] = $this->User_model->get_all();
        $this->load->view('admin/penghuni/header');
        $this->load->view('admin/penghuni/penghuni', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/penghuni/footer');
    }

    public function tambah_penghuni() {
        $this->load->view('admin/penghuni/header');
        $this->load->view('admin/penghuni/tambah_penghuni');
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/penghuni/footer');
    }
   public function simpan() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nama', 'Nama', 'required', [
        'required' => 'Nama wajib diisi.'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[penghuni.email]', [
        'required'   => 'Email wajib diisi.',
        'valid_email'=> 'Format email tidak valid.',
        'is_unique'  => 'Email sudah terdaftar.'
    ]);
    $this->form_validation->set_rules('no_hp', 'No HP', 'required|is_unique[penghuni.no_hp]', [
        'required'  => 'Nomor HP wajib diisi.',
        'is_unique' => 'Nomor HP sudah digunakan.'
    ]);
    $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
        'required' => 'Alamat wajib diisi.'
    ]);

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors('<div class="alert alert-danger">', '</div>'));
        redirect('admin/penghuni/tambah_penghuni');
        return;
    }

    $password = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);

    $data = [
        'nama'       => $this->input->post('nama', true),
        'email'      => $this->input->post('email', true),
        'no_hp'      => $this->input->post('no_hp', true),
        'password'   => $password, 
        'alamat'     => $this->input->post('alamat', true),
        'status'     => 'aktif',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($this->User_model->insertUser($data)) {
        $this->session->set_flashdata('success', 'Data penghuni berhasil disimpan. Password: ' . $password);
        redirect('admin/penghuni');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data penghuni. Silakan coba lagi.');
        redirect('admin/penghuni/tambah_penghuni');
    }


    
}

public function delete($id_penghuni) {
    $penghuni = $this->User_model->get_penghuni_by_id($id_penghuni);

    if (!$penghuni) {
        $this->session->set_flashdata('error', 'Penghuni tidak ditemukan.');
        redirect('admin/penghuni');
        return;
    }

    $hasBooking = $this->Booking_model->checkBookingByPenghuni($id_penghuni);
    if ($hasBooking) {
        $this->session->set_flashdata('error', 'Penghuni tidak bisa dihapus karena memiliki histori pemesanan.');
        redirect('admin/penghuni');
        return;
    }

    $hapus = $this->User_model->delete_penghuni($id_penghuni);

    if ($hapus) {
        $this->session->set_flashdata('success', 'Akun penghuni berhasil dihapus.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menghapus akun penghuni.');
    }

    redirect('admin/penghuni');
}


}
