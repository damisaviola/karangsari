<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_user_model extends CI_Model {

    public function getTagihanByUser($id_penghuni)
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
            pembayaran.status AS status_pembayaran,
            pembayaran.created_at AS pembayaran_created_at
        ');
        $this->db->from('booking');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar', 'left');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
        $this->db->join('pembayaran', 'pembayaran.id_booking = booking.id_booking', 'left');
        $this->db->where('booking.id_penghuni', $id_penghuni);
        $this->db->order_by('booking.created_at', 'DESC');

        return $this->db->get()->result();
    }






    public function updateBukti($id_pembayaran, $bukti) {
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->update('pembayaran', [
            'bukti_pembayaran' => $bukti,
            'status' => 'Menunggu Verifikasi'
        ]);
    }
}
?>
