<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fasilitas_model');
        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['fasilitas'] = $this->Fasilitas_model->getAllFasilitas();
          $this->load->view('admin/fasilitas/header');
          $this->load->view('admin/dashboard/sidebar');
          $this->load->view('admin/fasilitas/fasilitas', $data);
          $this->load->view('admin/fasilitas/footer');
    }

   public function tambah_aksi() {
    $nama_fasilitas = $this->input->post('nama_fasilitas', true);

    if (!empty($nama_fasilitas)) {
        $this->db->insert('fasilitas_kos', ['nama_fasilitas' => $nama_fasilitas]);
        $this->session->set_flashdata('success', 'Fasilitas berhasil ditambahkan.');
    } else {
        $this->session->set_flashdata('error', 'Nama fasilitas tidak boleh kosong.');
    }

    redirect('admin/fasilitas');
    }   

    public function delete($id) {
        $this->Fasilitas_model->delete($id);
        $this->session->set_flashdata('success', 'Fasilitas berhasil dihapus!');
        redirect('admin/fasilitas');
    }

        public function update()
    {
        $id = $this->input->post('id_fasilitas');
        $nama = $this->input->post('nama_fasilitas');

        $this->db->where('id_fasilitas', $id);
        $update = $this->db->update('fasilitas_kos', ['nama_fasilitas' => $nama]);

        if ($update) {
            $this->session->set_flashdata('success', 'Data fasilitas berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data fasilitas.');
        }

        redirect('admin/fasilitas');
    }

    public function hapus($id)
        {

            if ($this->input->method() !== 'post') {
                show_error('Metode tidak diizinkan', 405);
            }

            if (!$id || !is_numeric($id)) {
                show_error('ID tidak valid', 400);
            }

            $fasilitas = $this->Fasilitas_model->getById($id);
            if (!$fasilitas) {
                show_error('Data fasilitas tidak ditemukan', 404);
            }

            $this->Fasilitas_model->delete($id);
            echo json_encode(['status' => 'success']);
        }

}
