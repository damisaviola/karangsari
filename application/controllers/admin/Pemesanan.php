<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
       $this->load->view('admin/pemesanan/header');
       $this->load->view('admin/pemesanan/pemesanan');
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/pemesanan/footer');
    }

    public function tambah_pemesanan() {
        $data['penghuni'] = $this->db->get('penghuni')->result();
        $data['kamar'] = $this->db->get('kamar')->result();

        $this->load->view('admin/pemesanan/header');
        $this->load->view('admin/pemesanan/tambah_pemesanan', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pemesanan/footer');
    }



   public function simpan() {
    // Validasi input form
    $this->form_validation->set_rules('id_penghuni', 'Nama Penghuni', 'required');
    $this->form_validation->set_rules('id_kamar', 'Kamar', 'required');
    $this->form_validation->set_rules('bulan_mulai', 'Bulan Masuk', 'required');
    $this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'required');
    $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/pemesanan/tambah');
        return;
    }

    // Ambil data input yang sudah bersih
    $id_penghuni = $this->input->post('id_penghuni', true);
    $id_kamar = $this->input->post('id_kamar', true);
    $bulan_mulai = $this->input->post('bulan_mulai', true);
    $bulan_akhir = $this->input->post('bulan_akhir', true);
    $status_pembayaran = $this->input->post('status_pembayaran', true);
    $catatan = $this->input->post('catatan', true);

    // Validasi logis: bulan_akhir tidak boleh lebih kecil dari bulan_mulai
    if (strtotime($bulan_akhir) < strtotime($bulan_mulai)) {
        $this->session->set_flashdata('error', 'Bulan akhir tidak boleh sebelum bulan mulai.');
        redirect('admin/pemesanan/tambah');
        return;
    }

    // Siapkan data untuk disimpan
    $data = [
        'id_penghuni'       => $id_penghuni,
        'id_kamar'          => $id_kamar,
        'bulan_mulai'       => $bulan_mulai,
        'bulan_akhir'       => $bulan_akhir,
        'status_pembayaran' => $status_pembayaran,
        'catatan'           => $catatan,
        'tanggal_pemesanan' => date('Y-m-d H:i:s'),
        'status'            => 'dipesan'
    ];

    // Simpan ke database
    if ($this->Pemesanan_model->insert($data)) {

        // Ambil data penghuni untuk cek status
        $penghuni = $this->User_model->get_by_id($id_penghuni);
        if ($penghuni && $penghuni->status == 'nonaktif') {
            $this->User_model->update_status($id_penghuni, 'aktif');
        }

        // Update status kamar jadi 'dipesan'
        $this->Kamar_model->update_status($id_kamar, 'dipesan');

        $this->session->set_flashdata('success', 'Pemesanan berhasil disimpan dan status penghuni diaktifkan.');
        redirect('admin/pemesanan');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data pemesanan.');
        redirect('admin/pemesanan/tambah');
    }
}
}

?>