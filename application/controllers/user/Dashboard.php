<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
       $this->load->view('user/dashboard/header');
       $this->load->view('user/dashboard/dashboard');
       $this->load->view('user/dashboard/sidebar');
       $this->load->view('user/dashboard/footer');
    }
}

?>