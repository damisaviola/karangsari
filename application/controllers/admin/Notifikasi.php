<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
         if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
    $data['pembayaran'] = $this->Pembayaran_model->get_pembayaran_notifikasi();
       $this->load->view('admin/notif/header');
       $this->load->view('admin/notif/notif', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/notif/footer');
    }

      

}

?>