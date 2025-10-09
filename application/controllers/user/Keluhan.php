<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keluhan_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('id_penghuni')) {
            redirect('user/auth/login');
        }
    }

    public function index()
    {
     
        $id_penghuni = $this->session->userdata('id_penghuni');

        if ($id_penghuni) {
            $data['keluhan'] = $this->Keluhan_model->get_by_penghuni($id_penghuni);
        } else {
            $data['keluhan'] = $this->Keluhan_model->get_all();
        }

        $data['title'] = 'Data Keluhan';
        $this->load->view('user/keluhan/header');
        $this->load->view('user/keluhan/daftar-keluhan', $data);
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/keluhan/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Keluhan';
        $this->load->view('user/keluhan/header');
        $this->load->view('user/keluhan/tambah-keluhan', $data);
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/keluhan/footer');
    }

    public function simpan()
    {
        $id_penghuni = $this->session->userdata('id_penghuni');
        $pesan = $this->input->post('pesan');

        if (empty($pesan)) {
            $this->session->set_flashdata('error', 'Pesan keluhan tidak boleh kosong.');
            redirect('keluhan/tambah');
        }

        $data = [
            'id_penghuni' => $id_penghuni,
            'pesan'       => $pesan,
            'status'      => 'Menunggu',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $this->Keluhan_model->insert($data);
        $this->session->set_flashdata('success', 'Keluhan berhasil dikirim.');
        redirect('user/keluhan');
    }

    public function ubah_status($id_keluhan)
    {
        $status = $this->input->post('status');
        $this->Keluhan_model->update_status($id_keluhan, $status);
        $this->session->set_flashdata('success', 'Status keluhan berhasil diperbarui.');
        redirect('keluhan');
    }

    public function hapus($id_keluhan)
    {
        $this->Keluhan_model->delete($id_keluhan);
        $this->session->set_flashdata('success', 'Keluhan berhasil dihapus.');
        redirect('keluhan');
    }
}
