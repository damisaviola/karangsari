<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
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

    
}
?>
