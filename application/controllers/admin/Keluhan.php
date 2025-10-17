<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('Keluhan_model');
        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
    $data['keluhan'] = $this->Keluhan_model->get_all_user();
       $this->load->view('admin/keluhan/header');
       $this->load->view('admin/keluhan/data-keluhan', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/keluhan/footer');
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