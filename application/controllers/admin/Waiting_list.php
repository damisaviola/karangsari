<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waiting_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('Waiting_list_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $data['waiting_list'] = $this->Waiting_list_model->get_all();
        $this->load->view('admin/waiting/header');
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/waiting/waiting', $data);
        $this->load->view('admin/waiting/footer');
    }

 

    public function simpan()
{

    $this->form_validation->set_rules(
        'nama_lengkap',
        'Nama Lengkap',
        'required|trim|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z\s]+$/]',
        [
            'required' => 'Nama Lengkap wajib diisi.',
            'min_length' => 'Nama terlalu pendek (minimal 3 huruf).',
            'max_length' => 'Nama terlalu panjang.',
            'regex_match' => 'Nama hanya boleh berisi huruf dan spasi.'
        ]
    );

    $this->form_validation->set_rules(
        'email',
        'Email',
        'required|trim|valid_email|max_length[100]',
        [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'max_length' => 'Email terlalu panjang.'
        ]
    );

    $this->form_validation->set_rules(
        'no_hp',
        'No HP',
        'required|trim|regex_match[/^[0-9]{10,15}$/]',
        [
            'required' => 'Nomor HP wajib diisi.',
            'regex_match' => 'Nomor HP hanya boleh angka dan panjang antara 10-15 digit.'
        ]
    );

    $this->form_validation->set_rules(
        'catatan',
        'Catatan',
        'required|trim|min_length[3]',
        [
            'required' => 'Catatan wajib diisi.',
            'min_length' => 'Catatan terlalu pendek, minimal 3 karakter.'
        ]
    );

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/waiting_list/');
    }

    $data = [
        'id_admin' => $this->session->userdata('id_admin'),
        'nama_lengkap' => $this->input->post('nama_lengkap', true),
        'email' => $this->input->post('email', true),
        'no_hp' => $this->input->post('no_hp', true),
        'tanggal_daftar' => date('Y-m-d H:i:s'),
        'status' => 'menunggu',
        'catatan' => $this->input->post('catatan', true)
    ];

    if ($this->Waiting_list_model->insert_waiting($data)) {
        $this->session->set_flashdata('success', 'Data waiting list berhasil ditambahkan.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menambahkan data.');
    }

    redirect('admin/waiting_list');
}


     public function hapus($id_waiting)
    {
        if (empty($id_waiting)) {
            show_error('ID waiting list tidak valid.');
        }

        $deleted = $this->Waiting_list_model->delete($id_waiting);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Data waiting list berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan atau gagal dihapus.');
        }

        redirect('admin/waiting_list');
    }
    
}
