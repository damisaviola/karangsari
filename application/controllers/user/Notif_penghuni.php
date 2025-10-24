<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif_penghuni extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Keluhan_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Pembayaran_user_model');
        $this->load->model('Booking_model');
        
         if (!$this->session->userdata('id_penghuni')) {
            redirect('user/auth/login');
        }
    }

   public function index() {
    $id_penghuni = $this->session->userdata('id_penghuni');
    $data['tagihan'] = $this->Pembayaran_user_model->getTagihanByUser($id_penghuni);
    $this->load->view('user/notif_penghuni/header'); 
    $this->load->view('user/dashboard/sidebar');  
    $this->load->view('user/notif_penghuni/notif-penghuni', $data); 
    $this->load->view('user/notif_penghuni/footer');     
}


        public function update_status($id_keluhan, $status)
    {
        $allowed = ['Diproses', 'Selesai'];
        if (!in_array($status, $allowed)) {
            show_error('Status tidak valid', 400);
        }

        $this->db->where('id_keluhan', $id_keluhan)
                ->update('keluhan', ['status' => $status]);

        $this->session->set_flashdata('success', 'Status keluhan berhasil diperbarui.');
        redirect('admin/keluhan');
    }

}

?>