<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Booking_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->library('session');
      
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


public function create2()
{
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

    $data['available_rooms'] = $this->Booking_model->getAvailableRooms($check_in, $check_out);
    $data['check_in']  = html_escape($check_in);
    $data['check_out'] = html_escape($check_out);

    $this->load->view('home/results', $data);
}


 public function detail_kamar($id_kamar = null) {
    if (!$id_kamar) {
        $this->session->set_flashdata('error', 'Kamar tidak ditemukan.');
        redirect('home');
        return;
    }

    // Ambil data kamar dari model
    $data['room'] = $this->Booking_model->getRoomById($id_kamar);

    if (!$data['room']) {
        $this->session->set_flashdata('error', 'Kamar tidak tersedia.');
        redirect('home');
        return;
    }

    $this->load->view('home/detail-kamar', $data);
}


    



    
}
