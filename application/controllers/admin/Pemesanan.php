<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->model('Waiting_list_model');
        $this->load->model('Pembayaran_model');
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
        $data['waiting'] = $this->Waiting_list_model->get_all_waiting();
        $data['penghuni'] = $this->db->get('penghuni')->result();
        $data['kamar'] = $this->Kamar_model->get_kamar_tersedia();


        $this->load->view('admin/pemesanan/header');
        $this->load->view('admin/pemesanan/tambah_pemesanan', $data);
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/pemesanan/footer');
    }

    public function get_waiting_data()
    {
        $id_waiting = $this->input->post('id_waiting');
        $data = $this->Waiting_list_model->get_waiting_by_id($id_waiting);

        if ($data) {
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }


        public function hapus_booking($id_booking) {
        $booking = $this->Booking_model->get_by_id($id_booking);
        if (!$booking) {
            $this->session->set_flashdata('error', 'Booking tidak ditemukan.');
            redirect('admin/pemesanan');
            return;
        }

        if (!empty($booking->parent_booking_id)) {
            $this->Booking_model->update($booking->parent_booking_id, [
                'status_pembayaran' => 'lunas',
                'jumlah_perpanjangan' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $this->Booking_model->delete($id_booking);

        $this->session->set_flashdata('success', 'Booking berhasil dibatalkan dan status booking lama dikembalikan.');
        redirect('admin/pemesanan');
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

        $id_penghuni_raw = $this->input->post('id_penghuni', true);
        $nama_penghuni_baru = $this->input->post('nama_penghuni_baru', true);
        $email_penghuni_baru = $this->input->post('email_penghuni_baru', true);
        $no_hp_penghuni_baru = $this->input->post('no_hp_penghuni_baru', true);
        $alamat_penghuni_baru = $this->input->post('alamat_penghuni_baru', true);

        
        $id_penghuni = null;

        if (empty($id_penghuni_raw) && empty($nama_penghuni_baru)) {
            $this->session->set_flashdata('error', 'Silakan pilih penghuni lama atau isi data penghuni baru.');
            redirect('admin/pemesanan/tambah_pemesanan');
            return;
        }

        if (strpos($id_penghuni_raw, 'waiting_') === 0) {
            $id_waiting = str_replace('waiting_', '', $id_penghuni_raw);
            $waiting = $this->db->get_where('waiting_list', ['id_waiting' => $id_waiting])->row();

            if ($waiting) {
                $cek_ada = $this->db->get_where('penghuni', ['email' => $waiting->email])->row();
                if ($cek_ada) {
                    $id_penghuni = $cek_ada->id_penghuni;
                } else {
                    $password_random = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                    $data_penghuni = [
                        'nama' => $waiting->nama_lengkap,
                        'email' => $waiting->email,
                        'no_hp' => $waiting->no_hp,
                        'alamat' => $waiting->alamat,
                        'password' => $password_random,
                        'status' => 'aktif',
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('penghuni', $data_penghuni);
                    $id_penghuni = $this->db->insert_id();

                    $subject = 'Akun Anda Telah Aktif';
                    $message = "
                        <p>Hai <b>{$waiting->nama_lengkap}</b>,</p>
                        <p>Selamat! Anda telah resmi menjadi penghuni kami.</p>
                        <p>Email: {$waiting->email}<br>
                        Password: <b>{$password_random}</b></p>
                        <p>Silakan login dan ubah password Anda segera.</p>
                    ";
                    $this->mail->send($waiting->email, $subject, $message);
                }


                $this->db->delete('waiting_list', ['id_waiting' => $id_waiting]);
            }
        }

        else if (strpos($id_penghuni_raw, 'penghuni_') === 0) {
            $id_penghuni = str_replace('penghuni_', '', $id_penghuni_raw);
        }

        else if ($id_penghuni_raw == 'baru' && !empty($nama_penghuni_baru)) {
         
            $cek_email = $this->db->get_where('penghuni', ['email' => $email_penghuni_baru])->row();
            if ($cek_email) {
                $id_penghuni = $cek_email->id_penghuni;
            } else {
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
                $this->mail->send($email_penghuni_baru, $subject, $message);
            }
        }

        if (!is_numeric($id_penghuni)) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan pada data penghuni.');
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


        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->where_not_in('status_pembayaran', ['selesai', 'refund', 'dibatalkan']);
        $cek_booking_aktif = $this->db->get('booking')->row();

        if ($cek_booking_aktif) {
            $this->session->set_flashdata('error', 'Penghuni ini masih memiliki pemesanan aktif.');
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


        public function perpanjang_action()
        {

            $this->form_validation->set_rules('id_booking_lama', 'ID Booking Lama', 'required');
            $this->form_validation->set_rules('bulan_mulai_baru', 'Bulan Mulai Baru', 'required');
            $this->form_validation->set_rules('bulan_akhir_baru', 'Bulan Akhir Baru', 'required');
            $this->form_validation->set_rules('total_harga_baru', 'Total Bayar', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('admin/pemesanan');
                return;
            }

            $id_booking_lama = $this->input->post('id_booking_lama');
            $bulan_mulai_baru = $this->input->post('bulan_mulai_baru');
            $bulan_akhir_baru = $this->input->post('bulan_akhir_baru');
            $total_bayar = $this->input->post('total_harga_baru');

              if (strtotime($bulan_akhir_baru . '-01') < strtotime($bulan_mulai_baru . '-01')) {
            $this->session->set_flashdata('error', 'Bulan akhir tidak boleh lebih kecil dari bulan mulai.');
            redirect('admin/pemesanan');
            return;
        }


            $booking_lama = $this->Booking_model->getById($id_booking_lama);
            if (!$booking_lama) {
                $this->session->set_flashdata('error', 'Data booking lama tidak ditemukan.');
                redirect('admin/pemesanan');
                return;
            }

            $data_baru = [
                'id_penghuni'         => $booking_lama->id_penghuni,
                'id_kamar'            => $booking_lama->id_kamar,
                'id_admin'            => $this->session->userdata('id_admin'),
                'bulan_mulai'         => $bulan_mulai_baru,
                'bulan_akhir'         => $bulan_akhir_baru,
                'status_pembayaran'   => 'belum bayar', 
                'total_harga'         => $total_bayar,
                'jumlah_perpanjangan' => 0,
                'parent_booking_id'   => $id_booking_lama,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s')
            ];

            $this->Booking_model->insert($data_baru);

            $this->Booking_model->update($id_booking_lama, [
                'status_pembayaran'   => 'perpanjang',
                'jumlah_perpanjangan' => $booking_lama->jumlah_perpanjangan + 1,
                'updated_at'          => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('success', 'Perpanjangan berhasil dibuat! Booking lama diubah menjadi perpanjang.');
            redirect('admin/pemesanan');
        }


        public function hapus($id_booking) {
            $this->Booking_model->delete($id_booking);
            $this->session->set_flashdata('success', 'Data booking berhasil dihapus.');
            redirect('admin/pemesanan');
        }

            public function get_bulan_akhir($id_booking)
        {
        
            $data = $this->Booking_model->get_by_id1($id_booking);

            if ($data) {
                echo json_encode([
                    'status' => 'success',
                    'bulan_akhir' => $data->bulan_akhir
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }
        
        public function batalkan($id_booking)
        {
  
            $booking = $this->db->get_where('booking', ['id_booking' => $id_booking])->row();

            if ($booking) {
                $this->db->where('id_booking', $id_booking);
                $this->db->update('booking', ['status_pembayaran' => 'dibatalkan']);

                if (!empty($booking->id_kamar)) {
                    $kamar = $this->db->get_where('kamar', ['id_kamar' => $booking->id_kamar])->row();

                    if ($kamar && strtolower($kamar->status) == 'dihuni') {
                        $this->db->where('id_kamar', $booking->id_kamar);
                        $this->db->update('kamar', ['status' => 'tersedia']);
                    }
                }

                if (!empty($booking->id_penghuni)) {
                    $this->db->where('id_penghuni', $booking->id_penghuni);
                    $this->db->update('penghuni', ['status' => 'nonaktif']);
                }

                $this->session->set_flashdata('success', 'Pemesanan berhasil dibatalkan. Kamar telah tersedia (jika sebelumnya dihuni) dan akun dinonaktifkan.');
            } else {
                $this->session->set_flashdata('error', 'Data booking tidak ditemukan.');
            }

            redirect('admin/pemesanan');
        }


}

?>