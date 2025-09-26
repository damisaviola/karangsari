<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

  
    public function getAvailableRooms($check_in, $check_out) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->where('status', 'tersedia');

        // Filter kamar yang tidak sedang dipesan/dihuni di tanggal yang sama
        $this->db->where("id_kamar NOT IN (
            SELECT id_kamar FROM booking 
            WHERE status IN ('dipesan', 'dihuni')
            AND (check_in <= '$check_out' AND check_out >= '$check_in')
        )", NULL, FALSE);

        $query = $this->db->get();
        return $query->result();
    }

   public function getRoomById($id_kamar) {
    // Ambil data kamar
    $this->db->where('id_kamar', $id_kamar);
    $room = $this->db->get('kamar')->row_array();

    if (!$room) return null;

    // Ambil fasilitas kamar berdasarkan tabel penghubung
    $this->db->select('f.nama_fasilitas');
    $this->db->from('kamar_fasilitas kf');
    $this->db->join('fasilitas_kos f', 'kf.id_fasilitas = f.id_fasilitas', 'left');
    $this->db->where('kf.id_kamar', $id_kamar);
    $fasilitas = $this->db->get()->result_array();

    $room['fasilitas'] = array_column($fasilitas, 'nama_fasilitas');
    return $room;
}


}
