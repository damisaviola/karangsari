<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        
    }

    public function index() {
    $data['penghuni'] = $this->User_model->get_all();
       $this->load->view('admin/penghuni/header');
       $this->load->view('admin/penghuni/penghuni', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/penghuni/footer');
    }

    public function tambah_penghuni() {
        $this->load->view('admin/penghuni/header');
        $this->load->view('admin/penghuni/tambah_penghuni');
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/penghuni/footer');
    }
}

?>