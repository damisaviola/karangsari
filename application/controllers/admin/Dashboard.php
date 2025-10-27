<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Booking_model');
        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $result = $this->Booking_model->getBookingPerBulan();

    
    $data_bulan = array_fill(1, 12, 0);
    foreach ($result as $row) {
        $data_bulan[(int)$row->bulan] = (int)$row->total;
    }

    $chartData = [];
    foreach ($data_bulan as $bulan => $total) {
        $chartData[] = [
            'bulan' => $bulan,
            'total' => $total
        ];
    }

    $data['chart_data'] = json_encode($chartData);
        $data['penghuni'] = $this->User_model->get_latest(3);
    $data['jumlah_belum_bayar'] = $this->Booking_model->get_belum_bayar_count();
    
    $data['jumlah_penghuni_aktif'] = $this->User_model->count_penghuni_aktif();
    $data['jumlah_penghuni_nonaktif'] = $this->User_model->get_jumlah_penghuni_by_status('nonaktif');
    $data['jumlah_kamar_tersedia'] = $this->User_model->get_jumlah_kamar_by_status('tersedia');

       $this->load->view('admin/dashboard/header');
       $this->load->view('admin/dashboard/dashboard', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/dashboard/footer');
    }
}

?>