<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
       $this->load->view('admin/penghuni/header');
       $this->load->view('admin/penghuni/penghuni');
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/penghuni/footer');
    }
}

?>