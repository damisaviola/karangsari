<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Refund extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Refund_model');
        $this->load->model('Booking_model');
        $this->load->library(['form_validation', 'session']);
    }


    public function index()
    {
        $data['refunds'] = $this->Refund_model->getAllRefunds();
        $data['bookings_lunas'] = $this->Booking_model->get_bookings_lunas(); 
        $this->load->view('admin/refund/header');
        $this->load->view('admin/dashboard/sidebar');
        $this->load->view('admin/refund/refund', $data);
        $this->load->view('admin/refund/footer');
    }

        public function get_detail_booking($id_booking)
        {
            $data = $this->Booking_model->get_detail_booking($id_booking);

            if ($data && strtolower($data->status_pembayaran) === 'lunas') {
                $tanggal = isset($data->tanggal_booking)
                    ? $data->tanggal_booking
                    : (isset($data->created_at) ? $data->created_at : null);
                if ($tanggal) {
                    $data->tanggal_booking = date('d M Y, H:i', strtotime($tanggal));
                } else {
                    $data->tanggal_booking = '-';
                }

                echo json_encode($data);
            } else {
                echo json_encode(['error' => 'Data booking tidak ditemukan atau belum lunas.']);
            }
        }



            public function tambah()
        {
            $this->form_validation->set_rules('id_booking', 'ID Booking', 'required');
            $this->form_validation->set_rules('alasan', 'Alasan Refund', 'required');
            $this->form_validation->set_rules('jumlah_refund', 'Jumlah Refund', 'required|numeric');
            $this->form_validation->set_rules('metode_refund', 'Metode Refund', 'required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('admin/refund');
                return;
            }

            $id_booking = $this->input->post('id_booking');
            $alasan = $this->input->post('alasan');
            $jumlah_refund = $this->input->post('jumlah_refund');
            $metode_refund = $this->input->post('metode_refund');

            $id_admin = $this->session->userdata('id_admin');
            $data = [
                'id_booking' => $id_booking,
                'id_admin' => $id_admin,
                'jumlah_refund' => $jumlah_refund,
                'metode_refund' => $metode_refund,
                'status' => 'Diproses', 
                'alasan' => $alasan,
                'tanggal_refund' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $insert = $this->Refund_model->insert_refund($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Data refund berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data refund.');
            }

            redirect('admin/refund');
        }


                public function selesai($id_refund) {

                $refund = $this->Refund_model->getRefundById($id_refund);

                if (!$refund) {
                    $this->session->set_flashdata('error', 'Data refund tidak ditemukan.');
                    redirect('admin/refund');
                    return;
                }

                $this->Refund_model->updateStatus($id_refund, 'Selesai');
                $booking = $this->Booking_model->get_detail_booking($refund->id_booking);

                if ($booking) {
            
                    if (!empty($booking->parent_booking_id)) {

                        $this->Booking_model->update_status_pembayaran($booking->id_booking, 'dibatalkan');
                        $this->Booking_model->reset_jumlah_perpanjangan($booking->parent_booking_id);
                        $this->Booking_model->update_status_pembayaran($booking->parent_booking_id, 'lunas');

                        $this->session->set_flashdata('success', 'Refund perpanjangan berhasil diselesaikan dan parent booking diperbarui.');
                    } else {
                        $this->Booking_model->update_status_pembayaran($booking->id_booking, 'dibatalkan');
                        $this->Booking_model->update_status_kamar($booking->id_kamar, 'tersedia'); 
                        $this->Booking_model->nonaktifkan_penghuni($booking->id_penghuni); 

                        $this->session->set_flashdata('success', 'Refund reguler berhasil diselesaikan, kamar tersedia kembali, dan akun penghuni dinonaktifkan.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Detail booking tidak ditemukan.');
                }

                redirect('admin/refund');
            }

            public function update_status($id_refund)
            {
                $status = $this->input->post('status', true);
                $this->Refund_model->update_status($id_refund, $status);
                $refund = $this->Refund_model->get_refund_by_id($id_refund);
                if ($status === 'Selesai' && !empty($refund->id_booking)) {
                    $this->Booking_model->update_status_pembayaran($refund->id_booking, 'Dibatalkan');
                }

                $this->session->set_flashdata('success', 'Status refund berhasil diperbarui.');
                redirect('admin/refund');
            }
        public function delete($id_refund) {
                $refund = $this->Refund_model->get_by_id($id_refund);
                if (!$refund) {
                    echo json_encode(['status' => 'error', 'message' => 'Data refund tidak ditemukan.']);
                    return;
                }

                if (strtolower($refund->status) !== 'diproses') {
                    echo json_encode(['status' => 'error', 'message' => 'Refund hanya bisa dihapus jika statusnya masih Diproses.']);
                    return;
                }

                $this->Refund_model->delete($id_refund);
                echo json_encode(['status' => 'success', 'message' => 'Refund berhasil dihapus.']);
            }
        }
