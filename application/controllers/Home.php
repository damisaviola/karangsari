<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Booking_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->library('session');
         $this->load->model('User_model');
      
    }

    public function index() {
       
        $this->load->view('home/landing-page');
    }

    public function create() {
    $this->form_validation->set_rules('check_in', 'Check In', 'required');
    $this->form_validation->set_rules('check_out', 'Check Out', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('home');
        return;
    }

    $check_in  = $this->input->post('check_in', true);
    $check_out = $this->input->post('check_out', true);

    if ($check_out <= $check_in) {
        $this->session->set_flashdata('error', 'Check-out harus lebih besar dari Check-in.');
        redirect('home');
        return;
    }

    $data['available_rooms'] = $this->Booking_model->getAvailableRooms($check_in, $check_out);
    $data['check_in']        = $check_in;
    $data['check_out']       = $check_out;

    $this->load->view('home/results', $data);
}


public function create2() {
    $check_in  = $this->security->xss_clean($this->input->get('check_in', true));
    $check_out = $this->security->xss_clean($this->input->get('check_out', true));

    $inDate  = DateTime::createFromFormat('Y-m-d', $check_in);
    $outDate = DateTime::createFromFormat('Y-m-d', $check_out);

    if (!$inDate || !$outDate) {
        $this->session->set_flashdata('error', 'Format tanggal tidak valid.');
        redirect('home');
        return;
    }

    if ($outDate <= $inDate) {
        $this->session->set_flashdata('error', 'Check-out harus lebih besar dari Check-in.');
        redirect('home');
        return;
    }

    $monthly_rate = 1100000;
    $daily_rate   = $monthly_rate / 30; 

    $interval    = $inDate->diff($outDate);
    $total_days  = $interval->days;

    $total_price = round($total_days * $daily_rate);
    $this->session->set_userdata([
        'check_in'   => $check_in,
        'check_out'  => $check_out,
        'total_days' => $total_days,
        'daily_rate' => round($daily_rate),
        'total_price'=> $total_price
    ]);

    $data['available_rooms'] = $this->Booking_model->getAvailableRooms($check_in, $check_out);
    $data['check_in']        = $check_in;
    $data['check_out']       = $check_out;

    $this->load->view('home/results', $data);
}



   public function detail_kamar($id_kamar = null) {
    if ($id_kamar === null || !ctype_digit((string)$id_kamar)) {
        $this->session->set_flashdata('error', 'ID kamar tidak valid.');
        redirect('home');
        return;
    }

    $id_kamar = (int)$id_kamar;
    $room = $this->Booking_model->getRoomById($id_kamar);

    if (!$room) {
        $this->session->set_flashdata('error', 'Kamar tidak tersedia.');
        redirect('home');
        return;
    }
    $session_data = [
        'check_in'   => $this->session->userdata('check_in'),
        'check_out'  => $this->session->userdata('check_out'),
        'total_days' => $this->session->userdata('total_days'),
        'daily_rate' => $this->session->userdata('daily_rate'),
        'total_price'=> $this->session->userdata('total_price'),
    ];

    $data['room'] = $room;
    $data['session_data'] = $session_data;

    $this->load->view('home/detail-kamar', $data);
}
    
}
