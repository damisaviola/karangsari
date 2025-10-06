<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Cek session, jika tidak ada redirect ke login
        if (!$this->session->userdata('id_penghuni')) {
            redirect('user/auth/login');
        }

        // Tambahkan header anti-cache untuk mencegah back browser
        $this->output
            ->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT')
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache');
    }

    public function index() {
        $this->load->view('user/dashboard/header');
        $this->load->view('user/dashboard/dashboard');
        $this->load->view('user/dashboard/sidebar');
        $this->load->view('user/dashboard/footer');
    }
}
?>
