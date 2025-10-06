<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_user extends CI_Controller {

      public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_user_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Booking_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        $id_penghuni = $this->session->userdata('id_penghuni');
        

        $data['pembayaran'] = $this->Pembayaran_user_model->getTagihanByUser($id_penghuni);

        $this->load->view('user/pembayaran_user/header');
        $this->load->view('user/pembayaran_user/data-pembayaran', $data);
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/pembayaran_user/footer');
    }

    public function upload_bukti() {
    $id_booking = $this->input->post('id_booking');
    $keterangan = $this->input->post('keterangan');

    // Ambil data booking
    $booking = $this->Booking_model->get_booking_by_id($id_booking);

    if (!$booking) {
        $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
        redirect('user/pembayaran_user');
        return;
    }

    // Konfigurasi upload
    $config['upload_path'] = './uploads/bukti_transfer/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 2048;
    $config['file_name'] = 'bukti_' . time();

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('bukti_transfer')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('user/pembayaran_user');
        return;
    }

    $upload_data = $this->upload->data();

    // Cek apakah sebelumnya ada pembayaran yang ditolak untuk booking ini
    $this->db->where('id_booking', $id_booking);
    $this->db->where('status', 'Ditolak');
    $existing = $this->db->get('pembayaran')->row();

    $data = [
        'tanggal_bayar' => date('Y-m-d'),
        'jumlah_bayar' => $booking->total_harga,
        'metode_pembayaran' => 'Transfer Bank',
        'keterangan' => $keterangan,
        'bukti_transfer' => $upload_data['file_name'],
        'status' => 'Menunggu Verifikasi',
    ];

    if ($existing) {
        // update record lama yang ditolak
        $this->db->where('id_pembayaran', $existing->id_pembayaran);
        $this->db->update('pembayaran', $data);
    } else {
        // insert baru jika tidak ada pembayaran ditolak
        $data['id_booking'] = $id_booking;
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('pembayaran', $data);
    }

    // update status booking
    $this->db->where('id_booking', $id_booking);
    $this->db->update('booking', ['status_pembayaran' => 'Menunggu Verifikasi']);

    $this->session->set_flashdata('success', 'Bukti pembayaran berhasil dikirim dan menunggu verifikasi admin.');
    redirect('user/pembayaran_user');
}

}

?>