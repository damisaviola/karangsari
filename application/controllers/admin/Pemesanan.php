<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Kamar_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Pemesanan Kamar';
        $data['booking'] = $this->Booking_model->get_all();
       $this->load->view('admin/pemesanan/header');
       $this->load->view('admin/pemesanan/pemesanan', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/pemesanan/footer');
    }

    public function tambah_pemesanan() {
        $data['penghuni'] = $this->db->get('penghuni')->result();
        $data['kamar'] = $this->db->get('kamar')->result();
        $data['kamar'] = $this->Kamar_model->get_kamar_tersedia();


        $this->load->view('admin/pemesanan/header');
        $this->load->view('admin/pemesanan/tambah_pemesanan', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pemesanan/footer');
    }



   public function simpan() {
  
    $this->form_validation->set_rules('id_penghuni', 'Nama Penghuni', 'required');
    $this->form_validation->set_rules('id_kamar', 'Kamar', 'required');
    $this->form_validation->set_rules('bulan_mulai', 'Bulan Mulai', 'required');
    $this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'required');
    $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    $id_penghuni       = $this->input->post('id_penghuni', true);
    $id_kamar          = $this->input->post('id_kamar', true);
    $bulan_mulai       = $this->input->post('bulan_mulai', true);
    $bulan_akhir       = $this->input->post('bulan_akhir', true);
    $status_pembayaran = $this->input->post('status_pembayaran', true);
    $total_harga       = $this->input->post('total_harga', true);


    if (strtotime($bulan_akhir) < strtotime($bulan_mulai)) {
        $this->session->set_flashdata('error', 'Bulan akhir tidak boleh sebelum bulan mulai.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }


    $data = [
        'id_penghuni'       => $id_penghuni,
        'id_kamar'          => $id_kamar,
        'bulan_mulai'       => $bulan_mulai,
        'bulan_akhir'       => $bulan_akhir,
        'status_pembayaran' => $status_pembayaran,
        'total_harga'       => $total_harga,
        'created_at'        => date('Y-m-d H:i:s'),
        'updated_at'        => date('Y-m-d H:i:s')
    ];

    if ($this->Booking_model->insert($data)) {

        
        $penghuni = $this->User_model->get_by_id($id_penghuni);
        if ($penghuni && $penghuni->status == 'nonaktif') {
            $this->User_model->update_status($id_penghuni, 'aktif');
        }

        $this->Kamar_model->update_status($id_kamar, 'dihuni');

        $this->session->set_flashdata('success', 'Data pemesanan berhasil disimpan.');
        redirect('admin/pemesanan');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data pemesanan.');
        redirect('admin/pemesanan/tambah_pemesanan');
    }
}

}

?>