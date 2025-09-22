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


    
}
