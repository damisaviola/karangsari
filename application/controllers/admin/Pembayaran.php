<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Helpers;

class Pembayaran extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Booking_model');
        $this->load->model('Pembayaran_user_model');
        $this->load->helper('pdf_helper');
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
         if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['pembayaran'] = $this->Pembayaran_model->getAllPembayaran();
        $this->load->view('admin/pembayaran/header');
        $this->load->view('admin/pembayaran/pembayaran', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pembayaran/footer');
    }

    public function bayar_admin() {
    $data['pembayaran'] = $this->Pembayaran_model->getTagihanAllUsers();

    $this->load->view('admin/bayar_admin/header');
    $this->load->view('admin/bayar_admin/pembayaran-admin', $data);
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/bayar_admin/footer');
}

public function upload_bukti_admin() {
    $id_booking = $this->input->post('id_booking');
    $keterangan = $this->input->post('keterangan');
    $metode_pembayaran = $this->input->post('metode_pembayaran');

    $booking = $this->Booking_model->get_booking_by_id($id_booking);

    if (!$booking) {
        $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
        redirect('admin/pembayaran');
        return;
    }


    $id_admin = $this->session->userdata('id_admin'); 

    $data = [
        'tanggal_bayar' => date('Y-m-d'),
        'jumlah_bayar' => $booking->total_harga,
        'metode_pembayaran' => $metode_pembayaran,
        'keterangan' => $keterangan,
        'status' => 'Diterima', 
        'id_admin' => $id_admin, 
    ];

    if ($metode_pembayaran !== 'Tunai') {
        $config['upload_path'] = './uploads/bukti_transfer/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'bukti_' . time();

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('bukti_transfer')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/pembayaran');
            return;
        }

        $upload_data = $this->upload->data();
        $data['bukti_transfer'] = $upload_data['file_name'];
    }

  
    $this->db->where('id_booking', $id_booking);
    $this->db->where('status', 'Ditolak');
    $existing = $this->db->get('pembayaran')->row();

    if ($existing) {
     
        $this->db->where('id_pembayaran', $existing->id_pembayaran);
        $this->db->update('pembayaran', $data);
    } else {
     
        $data['id_booking'] = $id_booking;
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('pembayaran', $data);
    }


    $this->db->where('id_booking', $id_booking);
    $this->db->update('booking', ['status_pembayaran' => 'Lunas']);

    $this->session->set_flashdata('success', 'Bukti pembayaran berhasil dikirim oleh admin dan status pembayaran langsung Lunas.');
    redirect('admin/pembayaran');
}


     public function verifikasi($id_pembayaran) {

    $pembayaran = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row();

    if (!$pembayaran) {
        $this->session->set_flashdata('error', 'Data pembayaran tidak ditemukan.');
        redirect('admin/pembayaran');
    }
    
    $this->db->where('id_pembayaran', $id_pembayaran);
    $this->db->update('pembayaran', ['status' => 'Diterima']);


    $this->db->where('id_booking', $pembayaran->id_booking);
    $this->db->update('booking', ['status_pembayaran' => 'Lunas']);

    $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi dan status booking diperbarui.');
    redirect('admin/pembayaran');
}

    public function tolak($id_pembayaran) {
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->update('pembayaran', ['status' => 'Ditolak']);

        $this->session->set_flashdata('error', 'Pembayaran ditolak');
        redirect('admin/pembayaran');
    }
    

    public function tambah() {
        $data['booking'] = $this->Pembayaran_model->get_booking_list();
        $this->load->view('admin/pembayaran/header');
        $this->load->view('admin/pembayaran/tambah_pembayaran', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pembayaran/footer');
    }

    public function simpan() {
        $this->form_validation->set_rules('id_booking', 'Booking', 'required');
        $this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/pembayaran/tambah');
        } else {
            $data = [
                'id_booking' => $this->input->post('id_booking'),
                'tanggal_bayar' => date('Y-m-d'),
                'jumlah_bayar' => $this->input->post('jumlah_bayar'),
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
                'keterangan' => $this->input->post('keterangan')
            ];

            $this->Pembayaran_model->insert_pembayaran($data);
            $this->Pembayaran_model->update_status_booking($this->input->post('id_booking'));

            $this->session->set_flashdata('success', 'Pembayaran berhasil disimpan.');
            redirect('admin/pembayaran');
        }
    }


    public function print_pdf($id_pembayaran)
{
    $this->load->helper('pdf');
    $data['pembayaran'] = $this->Pembayaran_model->get_by_id($id_pembayaran);

    if (!$data['pembayaran']) {
        show_404();
    }

    $html = $this->load->view('admin/pembayaran/bukti_pdf', $data, true);
    $filename = 'Bukti_Pembayaran_' . $data['pembayaran']->id_pembayaran . '.pdf';

    generate_pdf($html, $filename);
}


}
