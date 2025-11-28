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

    public function delete($id_kamar) {
        $kamar = $this->Kamar_model->get_by_id($id_kamar);

        if (!$kamar) {
            $this->session->set_flashdata('error', 'Data kamar tidak ditemukan.');
            redirect('admin/kamar');
            return;
        }

        if ($kamar->status == 'dihuni') {
            $this->session->set_flashdata('error', 'Kamar masih dihuni, tidak bisa dihapus.');
            redirect('admin/kamar');
            return;
        }

        if ($this->Kamar_model->delete($id_kamar)) {
            $this->session->set_flashdata('success', 'Kamar berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kamar.');
        }

        redirect('admin/kamar');
    }

        public function get_status($id){
        $this->load->model('Kamar_model');
        $kamar = $this->Kamar_model->get_by_id($id);

        if ($kamar) {
            echo json_encode(['status' => $kamar->status]);
        } else {
            echo json_encode(['status' => null]);
        }
    }


        public function getById($id)
        {
            $kamar = $this->Kamar_model->getById($id);
            $fasilitas_all = $this->Fasilitas_model->getAllFasilitas();
            $fasilitas_kamar = $this->Kamar_model->getFasilitasByKamar($id);

            $fasilitas_ids = array_map(function($f) {
                return (string)$f->id_fasilitas;
            }, $fasilitas_kamar);

            echo json_encode([
                'kamar' => $kamar,
                'fasilitas_all' => $fasilitas_all,
                'fasilitas_kamar' => $fasilitas_ids
            ]);
        }

public function update()
{
    $id = $this->input->post('id_kamar');
    $data = [
        'nomor_kamar' => $this->input->post('nomor_kamar'),
        'lantai' => $this->input->post('lantai'),
        'harga' => $this->input->post('harga'),
        'status' => $this->input->post('status'),
        'deskripsi' => $this->input->post('deskripsi'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $update = $this->Kamar_model->update($id, $data);
    $this->Kamar_model->deleteKamarFasilitas($id);

    $fasilitas = $this->input->post('fasilitas');
    if (!empty($fasilitas)) {
        $dataFasilitas = [];
        foreach ($fasilitas as $fas) {
            $dataFasilitas[] = [
                'id_kamar' => $id,
                'id_fasilitas' => $fas
            ];
        }
        $this->Kamar_model->insertKamarFasilitas($dataFasilitas);
    }

    echo json_encode(['status' => $update ? 'success' : 'error']);
}




}



?>