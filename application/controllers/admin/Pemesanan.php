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
         if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
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
        $data['kamar'] = $this->Kamar_model->get_kamar_tersedia();


        $this->load->view('admin/pemesanan/header');
        $this->load->view('admin/pemesanan/tambah_pemesanan', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pemesanan/footer');
    }



   public function simpan()
{
    // Validasi umum
    $this->form_validation->set_rules('id_kamar', 'Kamar', 'required');
    $this->form_validation->set_rules('bulan_mulai', 'Bulan Mulai', 'required');
    $this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'required');
    $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');

    // Ambil input penghuni
    $id_penghuni = $this->input->post('id_penghuni', true);
    $nama_penghuni_baru = $this->input->post('nama_penghuni_baru', true);
    $no_hp_penghuni_baru = $this->input->post('no_hp_penghuni_baru', true);
    $email_penghuni_baru = $this->input->post('email_penghuni_baru', true);
    $alamat_penghuni_baru = $this->input->post('alamat_penghuni_baru', true);

    // Jika tidak pilih penghuni lama dan tidak isi data baru → error
    if (empty($id_penghuni) && empty($nama_penghuni_baru)) {
        $this->session->set_flashdata('error', 'Silakan pilih penghuni lama atau isi data penghuni baru.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    // Jalankan validasi
    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    // Ambil input lain
    $id_kamar = $this->input->post('id_kamar', true);
    $bulan_mulai = $this->input->post('bulan_mulai', true);
    $bulan_akhir = $this->input->post('bulan_akhir', true);
    $status_pembayaran = $this->input->post('status_pembayaran', true);
    $total_harga = $this->input->post('total_harga', true);

    // Validasi tanggal
    if (strtotime($bulan_akhir) < strtotime($bulan_mulai)) {
        $this->session->set_flashdata('error', 'Bulan akhir tidak boleh sebelum bulan mulai.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    // Jika ada penghuni baru, tambahkan ke tabel penghuni
    if (!empty($nama_penghuni_baru)) {
        $data_penghuni = [
            'nama' => $nama_penghuni_baru,
            'no_hp' => $no_hp_penghuni_baru,
            'email' => $email_penghuni_baru,
            'alamat' => $alamat_penghuni_baru,
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('penghuni', $data_penghuni);
        $id_penghuni = $this->db->insert_id(); 
    }

    $data_pemesanan = [
        'id_admin' => $this->session->userdata('id_admin'),
        'id_penghuni' => $id_penghuni,
        'id_kamar' => $id_kamar,
        'bulan_mulai' => $bulan_mulai,
        'bulan_akhir' => $bulan_akhir,
        'status_pembayaran' => $status_pembayaran,
        'total_harga' => $total_harga,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];


    if ($this->Booking_model->insert($data_pemesanan)) {
        $this->Kamar_model->update_status($id_kamar, 'dihuni');

        $this->session->set_flashdata('success', 'Pemesanan berhasil disimpan.');
        redirect('admin/pemesanan');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data pemesanan.');
        redirect('admin/pemesanan/tambah_pemesanan');
    }
}



}

?>