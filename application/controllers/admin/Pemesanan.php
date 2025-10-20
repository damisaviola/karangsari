<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->library('mail');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Kamar_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
         if (!$this->session->userdata('id_admin')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Data Pemesanan Kamar';
        $data['booking'] = $this->Booking_model->get_all();
       $this->load->view('admin/pemesanan/header');
       $this->load->view('admin/pemesanan/pemesanan', $data);
       $this->load->view('admin/dashboard/sidebar');
       $this->load->view('admin/pemesanan/footer');
    }

    public function tambah_pemesanan() {
        $data['penghuni'] = $this->db->get('penghuni')->result();
        $data['kamar'] = $this->Kamar_model->get_kamar_tersedia();


        $this->load->view('admin/pemesanan/header');
        $this->load->view('admin/pemesanan/tambah_pemesanan', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pemesanan/footer');
    }

 public function simpan() {
    $this->load->library(['form_validation', 'session', 'mail']);
    $this->load->model(['Booking_model', 'Kamar_model']);

    $this->form_validation->set_rules('id_kamar', 'Kamar', 'required');
    $this->form_validation->set_rules('bulan_mulai', 'Bulan Mulai', 'required');
    $this->form_validation->set_rules('bulan_akhir', 'Bulan Akhir', 'required');
    $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    $id_penghuni = $this->input->post('id_penghuni', true);
    $nama_penghuni_baru = $this->input->post('nama_penghuni_baru', true);
    $email_penghuni_baru = $this->input->post('email_penghuni_baru', true);
    $no_hp_penghuni_baru = $this->input->post('no_hp_penghuni_baru', true);
    $alamat_penghuni_baru = $this->input->post('alamat_penghuni_baru', true);

    if (empty($id_penghuni) && empty($nama_penghuni_baru)) {
        $this->session->set_flashdata('error', 'Silakan pilih penghuni lama atau isi data penghuni baru.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    $id_kamar = $this->input->post('id_kamar', true);
    $bulan_mulai = $this->input->post('bulan_mulai', true);
    $bulan_akhir = $this->input->post('bulan_akhir', true);
    $status_pembayaran = $this->input->post('status_pembayaran', true);
    $total_harga = $this->input->post('total_harga', true);

    if (strtotime($bulan_akhir) < strtotime($bulan_mulai)) {
        $this->session->set_flashdata('error', 'Bulan akhir tidak boleh sebelum bulan mulai.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

    if (!empty($nama_penghuni_baru)) {
        $password_random = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $data_penghuni = [
            'nama' => $nama_penghuni_baru,
            'email' => $email_penghuni_baru,
            'no_hp' => $no_hp_penghuni_baru,
            'alamat' => $alamat_penghuni_baru,
            'password' => $password_random, 
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('penghuni', $data_penghuni);
        $id_penghuni = $this->db->insert_id();

      
        $subject = 'Akun Baru Penghuni Kos';
        $message = "
            <p>Hai <b>{$nama_penghuni_baru}</b>,</p>
            <p>Akun kamu telah dibuat dengan informasi berikut:</p>
            <p>Email: {$email_penghuni_baru}<br>
            Password: <b>{$password_random}</b></p>
            <p>Silakan login dan ubah password segera.</p>
        ";

        if ($this->mail->send($email_penghuni_baru, $subject, $message)) {
            $this->session->set_flashdata('info', 'Akun penghuni baru berhasil dibuat dan email berhasil dikirim.');
        } else {
            $this->session->set_flashdata('info', 'Akun penghuni baru dibuat, namun email gagal dikirim.');
        }
    }

    $this->db->where('id_penghuni', $id_penghuni);
    $this->db->where_not_in('status_pembayaran', ['selesai', 'refund']);
    $cek_booking_aktif = $this->db->get('booking')->row();

    if ($cek_booking_aktif) {
        $this->session->set_flashdata('error', 'Penghuni ini masih memiliki pemesanan aktif atau belum selesai.');
        redirect('admin/pemesanan/tambah_pemesanan');
        return;
    }

   
    $penghuni = $this->db->get_where('penghuni', ['id_penghuni' => $id_penghuni])->row();
    if ($penghuni && $penghuni->status == 'nonaktif') {
        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->update('penghuni', ['status' => 'aktif', 'updated_at' => date('Y-m-d H:i:s')]);
    }


    $data_pemesanan = [
        'id_admin' => $this->session->userdata('id_admin'),
        'id_penghuni' => $id_penghuni,
        'id_kamar' => $id_kamar,
        'bulan_mulai' => $bulan_mulai,
        'bulan_akhir' => $bulan_akhir,
        'status_pembayaran' => $status_pembayaran,
        'total_harga' => $total_harga,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($this->Booking_model->insert($data_pemesanan)) {
        $this->Kamar_model->update_status($id_kamar, 'dihuni');
        $this->session->set_flashdata('success', 'Pemesanan berhasil disimpan.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data pemesanan.');
    }

    redirect('admin/pemesanan');
}


public function selesai($id_booking)
{

    $booking = $this->db->get_where('booking', ['id_booking' => $id_booking])->row();

    if ($booking) {

        $this->db->where('id_booking', $id_booking);
        $this->db->update('booking', ['status_pembayaran' => 'selesai']);

        if (!empty($booking->id_kamar)) {
            $this->db->where('id_kamar', $booking->id_kamar);
            $this->db->update('kamar', ['status' => 'tersedia']);
        }


        if (!empty($booking->id_penghuni)) {
            $this->db->where('id_penghuni', $booking->id_penghuni);
            $this->db->update('penghuni', ['status' => 'nonaktif']);
        }

        $this->session->set_flashdata('success', 'Booking telah diselesaikan. Kamar tersedia kembali dan penghuni dinonaktifkan.');
    } else {
        $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
    }

    redirect('admin/pemesanan');
}





}

?>