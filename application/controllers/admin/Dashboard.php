<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
       $this->load->view('admin/dashboard/header');
       $this->load->view('admin/dashboard/dashboard');
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/dashboard/footer');
    }
}

?>