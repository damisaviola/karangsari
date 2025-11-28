<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Kamar_model');
        $this->load->model('Booking_model');
        $this->load->model('Penghuni_model');
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('id_penghuni')) {
            redirect('user/auth/login');
        }

        $this->output
            ->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT')
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache');
    }

    public function index() {
        $id_penghuni = $this->session->userdata('id_penghuni');
        $bookings = $this->User_model->get_active_bookings($id_penghuni);
        $data = [
            'bookings' => $bookings,
            'total_booking_aktif' => count($bookings),
            'total_lunas' => $this->User_model->count_booking_by_status($id_penghuni, 'lunas'),
            'total_perpanjangan' => $this->User_model->count_perpanjangan($id_penghuni),
            'total_belum_lunas' => $this->User_model->count_booking_by_status($id_penghuni, 'belum bayar'),
            'nama' => $this->session->userdata('nama'),
            'email' => $this->session->userdata('email'),
        ];
         $id_penghuni = $this->session->userdata('id_penghuni'); 
        $data['bookings'] = $this->User_model->get_active_bookings_users($id_penghuni);
        $this->load->view('user/dashboard/header');
        $this->load->view('user/dashboard/dashboard', $data);
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/dashboard/footer');
    }

      public function checkout($id_booking) {
    if (!$this->session->userdata('logged_in')) {
        $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
        redirect('user/auth/login');
    }

    $id_penghuni = $this->session->userdata('id_penghuni');
    $booking = $this->Booking_model->get_booking_by_id($id_booking);

    if (!$booking) {
        $this->session->set_flashdata('error', 'Data pemesanan tidak ditemukan.');
        redirect('user/dashboard');
    }

    if ($booking->id_penghuni != $id_penghuni) {
        $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        redirect('user/dashboard');
    }

    if ($booking->status_pembayaran !== 'lunas') {
        $this->session->set_flashdata('error', 'Checkout hanya dapat dilakukan jika pembayaran sudah lunas.');
        redirect('user/dashboard');
    }

    $this->db->trans_start();
    $this->Booking_model->update_status_pembayaran($id_booking, 'selesai');
    $this->Penghuni_model->update_status($id_penghuni, 'nonaktif');

    $this->Kamar_model->update_status($booking->id_kamar, 'tersedia');
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $this->session->set_flashdata('error', 'Terjadi kesalahan saat melakukan checkout.');
    } else {
        $this->session->set_flashdata('success', 'Checkout berhasil! Akun Anda kini nonaktif dan kamar tersedia kembali.');
    }

    redirect('user/dashboard');
}


    
}
?>
