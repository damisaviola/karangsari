<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kamar_model');
        $this->load->model('Fasilitas_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['kamar'] = $this->Kamar_model->get_all();
       $this->load->view('admin/kamar/header');
       $this->load->view('admin/kamar/kamar', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/kamar/footer');
    }

    public function tambah_kamar() {
        
        $data['fasilitas'] = $this->Fasilitas_model->getAllFasilitas();
       $this->load->view('admin/kamar/header');
       $this->load->view('admin/kamar/tambah_kamar', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/kamar/footer');
    }
    
   public function simpan() {
    $this->form_validation->set_rules('nomor_kamar','Nomor Kamar','required|trim');
    $this->form_validation->set_rules('lantai','Lantai','required|integer');
    $this->form_validation->set_rules('harga','Harga','required|numeric');
    $this->form_validation->set_rules('status','Status','required|trim');
    $this->form_validation->set_rules('deskripsi','Deskripsi','trim');

    if ($this->form_validation->run() == FALSE) {
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect('admin/kamar/tambah_kamar');
        return;
    }

    $dataKamar = [
        'nomor_kamar' => $this->input->post('nomor_kamar', true),
        'lantai'      => $this->input->post('lantai', true),
        'harga'       => $this->input->post('harga', true),
        'status'      => $this->input->post('status', true),
        'deskripsi'   => $this->input->post('deskripsi', true),
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ];

    $idKamar = $this->Kamar_model->insertKamar($dataKamar);

    $fasilitas = $this->input->post('fasilitas', true);
    if (!empty($fasilitas)) {
        $dataFasilitas = [];
        foreach ($fasilitas as $fas) {
            $dataFasilitas[] = [
                'id_kamar' => $idKamar,
                'id_fasilitas' => $fas
            ];
        }
        $this->Kamar_model->insertKamarFasilitas($dataFasilitas);
    }

    $this->session->set_flashdata('success', 'Kamar berhasil disimpan!');
    redirect('admin/kamar');
}


}



?>