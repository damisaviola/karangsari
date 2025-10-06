<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    public function get_all_pembayaran() {
        $this->db->select('pembayaran.*, booking.total_harga as total_booking, penghuni.nama, kamar.nomor_kamar');
        $this->db->from('pembayaran');
        $this->db->join('booking', 'booking.id_booking = pembayaran.id_booking');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->order_by('pembayaran.tanggal_bayar', 'DESC');
        return $this->db->get()->result();
    }

    public function get_booking_list() {
        $this->db->select('booking.id_booking, penghuni.nama, kamar.nomor_kamar, booking.total_harga, booking.status_pembayaran');
        $this->db->from('booking');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->where('booking.status_pembayaran !=', 'lunas'); // hanya tampil yang belum lunas
        return $this->db->get()->result();
    }

    public function getTagihanAllUsers()
{
    $this->db->select('
        booking.id_booking,
        booking.id_kamar,
        booking.id_penghuni,
        booking.bulan_mulai,
        booking.bulan_akhir,
        booking.total_harga,  
        booking.status_pembayaran AS status_booking,
        booking.created_at AS booking_created_at,
        kamar.nomor_kamar,
        penghuni.nama AS nama_penghuni,
        pembayaran.id_pembayaran,
        pembayaran.tanggal_bayar,
        pembayaran.jumlah_bayar,
        pembayaran.metode_pembayaran,
        pembayaran.keterangan,
        pembayaran.bukti_transfer,
        pembayaran.status AS status_pembayaran_detail,
        pembayaran.created_at AS pembayaran_created_at
    ');
    $this->db->from('booking');
    $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar', 'left');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->join('pembayaran', 'pembayaran.id_booking = booking.id_booking', 'left');
    $this->db->order_by('booking.created_at', 'DESC');

    return $this->db->get()->result();
}


   public function insert_pembayaran($data) {
    if ($this->db->insert('pembayaran', $data)) {
        $id_booking = $data['id_booking'];
        $this->update_status_booking($id_booking);

        return true; 
    } else {
        return false; 
    }
}

public function getAllTagihan()
{
    $this->db->select('
        booking.id_booking,
        booking.id_kamar,
        booking.id_penghuni,
        booking.bulan_mulai,
        booking.bulan_akhir,
        booking.total_harga,  
        booking.status_pembayaran AS status_booking,
        booking.created_at AS booking_created_at,
        kamar.nomor_kamar,
        penghuni.nama AS nama_penghuni,
        pembayaran.id_pembayaran,
        pembayaran.tanggal_bayar,
        pembayaran.jumlah_bayar,
        pembayaran.metode_pembayaran,
        pembayaran.keterangan,
        pembayaran.bukti_transfer,
        pembayaran.status AS status_pembayaran_detail,
        pembayaran.created_at AS pembayaran_created_at
    ');
    $this->db->from('booking');
    $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar', 'left');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->join('pembayaran', 'pembayaran.id_booking = booking.id_booking', 'left');
    $this->db->order_by('booking.created_at', 'DESC');

    return $this->db->get()->result();
}



    private function update_status_booking($id_booking) {
    // pastikan booking ada
    $this->db->where('id_booking', $id_booking);
    $this->db->update('booking', ['status_pembayaran' => 'Menunggu Verifikasi']);
}

    public function getAllPembayaran()
{
    $this->db->select('
        pembayaran.id_pembayaran,
        pembayaran.id_booking,
        pembayaran.tanggal_bayar,
        pembayaran.jumlah_bayar,
        pembayaran.metode_pembayaran,
        pembayaran.keterangan,
        pembayaran.bukti_transfer,
        pembayaran.created_at,
        pembayaran.status AS status_pembayaran,  
        penghuni.nama AS nama_penghuni
    ');
    $this->db->from('pembayaran');
    $this->db->join('booking', 'booking.id_booking = pembayaran.id_booking', 'left');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->order_by('pembayaran.created_at', 'DESC');
    return $this->db->get()->result();
}
        public function get_pembayaran_terbaru()
        {
            $this->db->select('b.id_booking, b.nama_penghuni, b.nomor_kamar, b.bulan_mulai, b.bulan_akhir, b.total_harga, p.id_pembayaran, p.status_pembayaran_detail, p.bukti_transfer, p.keterangan, p.created_at AS pembayaran_created_at');
            $this->db->from('booking b');
            $this->db->join('pembayaran p', 'p.id_pembayaran = (
                SELECT MAX(p2.id_pembayaran) 
                FROM pembayaran p2 
                WHERE p2.id_booking = b.id_booking
            )', 'left');
            $this->db->order_by('b.id_booking', 'ASC');

            $query = $this->db->get();
            return $query->result();
        }

 public function get_pembayaran_belum_lunas() {
    $this->db->select('
        pembayaran.id_pembayaran,
        pembayaran.id_booking,
        pembayaran.tanggal_bayar,
        pembayaran.jumlah_bayar,
        pembayaran.metode_pembayaran,
        pembayaran.keterangan,
        pembayaran.bukti_transfer,
        pembayaran.created_at AS pembayaran_created_at,
        pembayaran.status AS status_pembayaran,
        booking.id_penghuni,
        booking.id_kamar,
        booking.bulan_mulai,
        booking.bulan_akhir,
        booking.total_harga,
        booking.status_pembayaran AS status_booking,
        booking.created_at AS booking_created_at,
        penghuni.nama AS nama_penghuni
    ');
    $this->db->from('pembayaran');
    $this->db->join('booking', 'booking.id_booking = pembayaran.id_booking', 'left');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');

    // filter hanya booking yang belum bayar
    $this->db->where('booking.status_pembayaran', 'belum bayar');

    $this->db->order_by('pembayaran.created_at', 'DESC');
    return $this->db->get()->result();
}






}
