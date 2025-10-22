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
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

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
    $booking = $this->Booking_model->get_booking_by_id($id_booking);

    if (!$booking) {
        $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
        redirect('user/pembayaran_user');
        return;
    }

    if (empty($_FILES['bukti_transfer']['name'])) {
        $this->session->set_flashdata('error', 'Silakan pilih file bukti transfer terlebih dahulu.');
        redirect('user/pembayaran_user');
        return;
    }

    $allowed_types = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_types)) {
        $this->session->set_flashdata('error', 'Format file tidak valid. Hanya diperbolehkan JPG, JPEG, atau PNG.');
        redirect('user/pembayaran_user');
        return;
    }

    $config['upload_path'] = './uploads/bukti_transfer/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 2048; // 2MB
    $config['file_name'] = 'bukti_' . time();

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('bukti_transfer')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('user/pembayaran_user');
        return;
    }

    $upload_data = $this->upload->data();

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
        $this->db->where('id_pembayaran', $existing->id_pembayaran);
        $this->db->update('pembayaran', $data);
    } else {
        $data['id_booking'] = $id_booking;
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('pembayaran', $data);
    }

    $this->db->where('id_booking', $id_booking);
    $this->db->update('booking', ['status_pembayaran' => 'Menunggu Verifikasi']);

    $this->session->set_flashdata('success', 'Bukti pembayaran berhasil dikirim dan menunggu verifikasi admin.');
    redirect('user/pembayaran_user');
}

public function print_pdf($id_pembayaran)
{
    $this->load->helper('pdf');
    $data['pembayaran'] = $this->Pembayaran_model->get_by_id($id_pembayaran);

    if (!$data['pembayaran']) {
        show_404();
    }

    $html = $this->load->view('admin/pembayaran/bukti_pdf', $data, true);
    $filename = 'Bukti_Pembayaran_' . $data['pembayaran']->id_pembayaran . '.pdf';

    generate_pdf($html, $filename);
}


}

?>