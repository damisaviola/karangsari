<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
       $this->load->view('admin/kamar/header');
       $this->load->view('admin/kamar/kamar');
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/kamar/footer');
    }

    public function tambah_kamar() {
       $this->load->view('admin/kamar/header');
       $this->load->view('admin/kamar/tambah_kamar');
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/kamar/footer');
    }
}

?>